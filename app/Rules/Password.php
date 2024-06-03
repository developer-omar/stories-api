<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Password implements ValidationRule {
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $pregMatch = preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[$@$!%*?&#.,:$($)$-$_]){8,}/i', $value);
        if($pregMatch !== 1)
            $fail('El campo :attribute debe contener mayúsculas, minúsculas, números y símbolos.');
    }
}
