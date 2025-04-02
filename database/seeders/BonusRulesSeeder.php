<?php

namespace Database\Seeders;

use App\Models\BonusRule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BonusRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BonusRule::create([
            'name' => 'base_rate',
            'multiplier' => 1,
            'priority' => 0,
            'condition' => json_encode([]),
        ]);

        BonusRule::create([
            'name' => 'holiday_bonus',
            'multiplier' => 2,
            'priority' => 1,
            'condition' => json_encode(['is_holiday' => true]),
        ]);

        BonusRule::create([
            'name' => 'vip_boost',
            'multiplier' => 1.4,
            'priority' => 2,
            'condition' => json_encode(['customer_status' => 'vip']),
        ]);
    }
}
