<?php

namespace App\Helpers;

class CurrencyHelper
{
    public static function format($amount)
    {
        return 'Rp ' . number_format($amount, 0, ',', '.');
    }
}
