<?php

namespace Joshluongo\FilamentAbnAcn\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;
use Illuminate\Translation\PotentiallyTranslatedString;

/**
 * Based on: https://gist.github.com/paulferrett/8141303
 */
class Acn implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $weights = [8, 7, 6, 5, 4, 3, 2, 1, 0];

        // Strip non-numbers from the ACN
        $acn = preg_replace('/[^0-9]/', '', $value);

        // Check that the ACN is exactly 9 characters long
        if (strlen($acn) !== 9) {
            $fail(Lang::get('filament-abn-acn::filament-abn-acn.acn.length'));

            return;
        }

        // Calculate the weighted sum of the digits
        $sum = 0;
        foreach (str_split($acn) as $key => $digit) {
            $sum += $digit * $weights[$key];
        }

        // Get the remainder
        $remainder = $sum % 10;

        // Calculate the complement
        $complement = 10 - $remainder;

        // If the complement is 10, set it to 0
        if ($complement === 10) {
            $complement = 0;
        }

        // Check if the last digit of the ACN matches the complement
        if ($acn[8] !== (string) $complement) {
            $fail(Lang::get('filament-abn-acn::filament-abn-acn.acn.invalid'));
        }
    }
}
