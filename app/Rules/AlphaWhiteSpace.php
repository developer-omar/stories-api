<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class AlphaWhiteSpace implements ValidationRule {
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $pregMatch = preg_match('/[^a-zñA-ZÑ ]/', $value);
        if ($pregMatch)
            $fail("El campo solo puede contener letras.");
    }
}
