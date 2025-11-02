<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Filter implements ValidationRule
{
    protected array $forbidden = [
        // 'admin',
        // 'superuser',
        // 'root',
        // 'laravel',
    ];

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
         if (in_array(strtolower($value), array_map('strtolower', $this->forbidden))) {
            $fail("The {$attribute} contains an invalid value.");
        }
    }
}
