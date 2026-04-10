<?php

if (!function_exists('country_flag')) {
    function country_flag(string $countryCode): string
    {
        $code = strtoupper(trim($countryCode));
        if (strlen($code) !== 2 || !ctype_alpha($code)) return '';

        // mb_chr fallback, ha nincs mbstring
        if (function_exists('mb_chr')) {
            return mb_chr(127397 + ord($code[0]), 'UTF-8')
                 . mb_chr(127397 + ord($code[1]), 'UTF-8');
        }

        return '';
    }
}

if (!function_exists('shipping_fee')) {
    function shipping_fee(?string $countryCode, string $paymentMethod = 'card'): float
    {
        if ($paymentMethod === 'pickup') return 0.0;

        $code = strtoupper(trim((string) $countryCode));
        if ($code === '' || strlen($code) !== 2 || !ctype_alpha($code)) {
            return (float) config('shipping.default', 20.0);
        }

        $overrides = (array) config('shipping.overrides', []);
        if (array_key_exists($code, $overrides)) {
            return (float) $overrides[$code];
        }

        $continents = (array) config('continents', []);
        $continent = $continents[$code] ?? null;

        $rates = (array) config('shipping.continent_rates', []);
        if ($continent && array_key_exists($continent, $rates)) {
            return (float) $rates[$continent];
        }

        return (float) config('shipping.default', 20.0);
    }
}