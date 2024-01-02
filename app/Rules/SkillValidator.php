<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\Skill;

class SkillValidator implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        foreach ($value as $skillId) {
            $exists = Skill::where('id', $skillId)->exists();

            if (!$exists) {
                $fail('One or more skill IDs do not exist.');
            }
        }
    }
}