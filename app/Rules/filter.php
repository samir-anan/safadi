<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class filter implements Rule
{
    protected $forbidden;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($forbidden)
    {
        $this->forbidden = $forbidden;
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
//        if ($value == $this->forbidden){
//            return false;
//        }
       // return !(strtolower($value) == 'laravel');
        return !(in_array(strtolower($value),$this->forbidden));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The value not allowed ';
    }
}
