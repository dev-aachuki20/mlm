<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidWithdrawalAmount implements Rule
{
    protected $availableBalance;

    public function __construct($availableBalance)
    {
        $this->availableBalance = $availableBalance;
    }

    public function passes($attribute, $value)
    {
        return (float)$value <= (float)$this->availableBalance;
    }

    public function message()
    {
        return 'The withdrawal amount cannot be more than the available balance.';
    }
}

