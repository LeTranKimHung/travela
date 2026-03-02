<?php

if (!function_exists('format_currency')) {
    function format_currency($amount)
    {
        if ($amount === null || $amount === '') {
            return '';
        }

        $currency = session('currency', 'VND');

        if ($currency === 'USD') {
            $usdAmount = $amount / 25400; // Tỷ giá giả định 25.400 VNĐ / 1 USD
            return '$' . number_format($usdAmount, 2, '.', ',');
        }

        return number_format($amount, 0, ',', '.') . ' VNĐ';
    }
}
