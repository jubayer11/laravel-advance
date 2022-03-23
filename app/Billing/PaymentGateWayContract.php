<?php

namespace App\Billing;

interface PaymentGateWayContract
{
    public function charge($amount);

    public function setDiscount($amount);
}
