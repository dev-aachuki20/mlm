<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CommissionRule implements Rule
{
    private $planPrize;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($planPrize)
    {
       $this->planPrize = $planPrize;
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
       $plan_prize = (float)$this->planPrize;
       if($plan_prize < (float)$value){
            return false;
       }else{
            return true;
       }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Commission should be less than the plan prize.';
    }
}
