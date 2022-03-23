<?php

namespace App\Billing;

use Illuminate\Support\Str;

class BankPaymentGateWay implements PaymentGateWayContract
{
    private $currency;
    private $discount = 0;

    public function __construct($currency)
    {
        $this->currency = $currency;
    }

    public function charge($amount)
    {
        return
            [
                'amount' => $amount - $this->discount,
                'confirmation_number' => Str::random(),
                'currency' => $this->currency,
                'discount' => $this->discount,
            ];
    }

    public function setDiscount($amount)
    {
        $this->discount = $amount;

    }
}
