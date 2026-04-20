<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Translation\PotentiallyTranslatedString;

class NoOffensiveContent implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  Closure(string, ?string=): PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
    }
    public function passes($attribute, $value)
{
    $badWords = ['badword1', 'badword2'];

    foreach ($badWords as $word) {
        if (str_contains(strtolower($value), $word)) {
            return false;
        }
    }

    return true;
}

public function message()
{
    return 'The :attribute contains inappropriate content.';
}
}
