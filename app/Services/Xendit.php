<?php

namespace App\Services;

use Xendit\PaymentMethod\PaymentMethodApi;
use Xendit\PaymentRequest\PaymentRequestApi;

class Xendit
{
    public PaymentMethodApi $paymentMethodApi;

    public PaymentRequestApi $paymentRequestApi;

    public function __construct()
    {
        $this->paymentMethodApi = new PaymentMethodApi();
        $this->paymentRequestApi = new PaymentRequestApi();
    }
}
