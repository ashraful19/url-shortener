<?php

namespace App\Rules;

use Facades\App\Services\SafeBrowsingService; //it is a service class with realtime facade implementation
use Illuminate\Contracts\Validation\Rule;

class SafeUrl implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return SafeBrowsingService::isSafe($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a Safe URL.';
    }
}
