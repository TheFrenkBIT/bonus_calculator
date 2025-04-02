<?php

namespace App\Services;

use App\Models\BonusRule;

class BonusCalculator
{
    public function calculateBonus($transactionAmount, $timestamp, $customerStatus): array
    {
        $rules = BonusRule::getSortedRules();
        $bonus = 0;
        $appliedRules = [];

        $baseRate = floor($transactionAmount / 10);
        $bonus += $baseRate;
        $appliedRules[] = ['rule' => 'base_rate', 'bonus' => $baseRate];

        foreach ($rules as $rule) {
            if ($this->checkRuleCondition($rule, $timestamp, $customerStatus)) {
                $bonusByRule = $bonus * $rule->multiplier - $bonus;
                $bonus += $bonusByRule;
                $appliedRules[] = ['rule' => $rule->name, 'bonus' => $bonusByRule];
            }
        }

        return [
            'total_bonus' => $bonus,
            'applied_rules' => $appliedRules
        ];
    }

    private function checkRuleCondition($rule, $timestamp, $customerStatus): bool
    {
        $isWeekend = in_array(date('w', strtotime($timestamp)), [0, 6]);

        $isVip = $customerStatus == 'vip';

        if ($rule->name == 'holiday_bonus' && $isWeekend) {
            return true;
        }
        if ($rule->name == 'vip_boost' && $isVip) {
            return true;
        }

        return false;
    }
}