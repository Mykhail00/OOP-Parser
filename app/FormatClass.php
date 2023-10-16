<?php

declare(strict_types=1);

namespace App;

class FormatClass
{
    public static function formatDate(int $timestamp): string
    {
        return \DateTime::createFromFormat('U', (string) $timestamp)->format('M d, Y');
    }

    public static function formatAmount(float $amount): string
    {
        $isNegative = $amount < 0;

        return ($isNegative ? '-' : '') . '$' . number_format(abs($amount), 2);
    }
}