<?php

namespace App\Rules;

use Hash;
use Illuminate\Contracts\Validation\Rule;

class DifferentTo implements Rule
{
    private $comparant;

    /**
     * Create a new rule instance.
     *
     * @param $comparant
     */
    public function __construct($comparant)
    {
        $this->comparant = $comparant;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (Hash::needsRehash($this->comparant) && Hash::needsRehash($value)) {
            return strcmp($this->comparant, $value) != 0;
        }
        if (Hash::needsRehash($this->comparant) && !Hash::needsRehash($value)) {
            return Hash::check($this->comparant, $value);
        }
        return Hash::check($value, $this->comparant);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.different_to');
    }
}
