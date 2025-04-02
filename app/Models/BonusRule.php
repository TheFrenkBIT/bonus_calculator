<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BonusRule extends Model
{
    protected $fillable = ['name', 'multiplier', 'priority', 'condition'];

    public static function getSortedRules()
    {
        return self::orderBy('priority')->get();
    }
}
