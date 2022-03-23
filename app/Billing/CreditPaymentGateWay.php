<?php

namespace App\Billing;

use Illuminate\Support\Str;

class CreditPaymentGateWay implements PaymentGateWayContract
{
    private $currency;
    private $discount = 0;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function charge($amount)
    {
        $fees = $amount * 0.03;
        return
            [
                'amount' => ($amount - $this->discount) + $fees,
                'confirmation_number' => Str::random(),
                'currency' => $this->currency,
                'discount' => $this->discount,
                'fees' => $fees,
            ];
    }

    public function setDiscount($amount)
    {
        $this->discount = $amount;

    }
}
