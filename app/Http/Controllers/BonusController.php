<?php

namespace App\Http\Controllers;

use App\Enums\CustomerTypeEnum;
use App\Services\BonusCalculator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BonusController extends Controller
{

    public function __construct(
        private readonly BonusCalculator $bonusCalculator
    )
    {
    }

    public function calculate(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'transaction_amount' => 'required|numeric',
            'timestamp' => 'required|date',
            'customer_status' => ['required', Rule::enum(CustomerTypeEnum::class)],
        ]);

        $result = $this->bonusCalculator->calculateBonus(
            $validated['transaction_amount'],
            $validated['timestamp'],
            $validated['customer_status']
        );

        return response()->json($result);
    }
}
