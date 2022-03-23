<?php

namespace App\Orders;
use App\Billing\PaymentGateWayContract;

class OrderDetails
{
    private $paymentGateWay;

    public function __construct(PaymentGateWayContract $paymentGateWay)
    {
        $this->paymentGateWay = $paymentGateWay;

    }

    public function all()
    {
        $this->paymentGateWay->setDiscount(50);
        return [
            'name'=>'Victor',
            'address'=>'15 adabar',
        ];
    }

}
