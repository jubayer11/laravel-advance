<?php

namespace App\Http\Controllers;

use App\Billing\BankPaymentGateWay;
use App\Billing\PaymentGateWayContract;
use App\Orders\OrderDetails;
use Illuminate\Http\Request;

class PayOrderController extends Controller
{
    //
    public function store(OrderDetails $orderDetails, PaymentGateWayContract $paymentGateWay)
    {
//        $paymentGateway = new BankPaymentGateWay();
        $order = $orderDetails->all();
        dd($paymentGateWay->charge(4500));
    }
}
