<?php

namespace Joshluongo\FilamentAbnAcn\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Lang;
use Illuminate\Translation\PotentiallyTranslatedString as PotentiallyTranslatedStringAlias;

/**
 * Based on: https://gist.github.com/paulferrett/8141303
 */
class Abn implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): PotentiallyTranslatedStringAlias  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $weights = [10, 1, 3, 5, 7, 9, 11, 13, 15, 17, 19];

        // Remove any non-digit characters from the ABN
        $abn = preg_replace('/[^0-9]/', '', $value);

        // Check that the ABN is exactly 11 characters long
        if (strlen($abn) !== 11) {
            $fail(Lang::get('filament-abn-acn::filament-abn-acn.abn.length'));

            return;
        }

        // Subtract 1 from the first digit
        $abn[0] = (int) $abn[0] - 1;

        // Calculate the weighted sum of the digits
        $sum = 0;
        foreach (str_split($abn) as $key => $digit) {
            $sum += $digit * $weights[$key];
        }

        // Check if the sum is divisible by 89
        if ($sum % 89 !== 0) {
            $fail(Lang::get('filament-abn-acn::filament-abn-acn.abn.invalid'));
        }
    }
}
