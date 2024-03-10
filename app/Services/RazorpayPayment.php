<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;

class RazorpayPayment implements PaymentGatewayInterface
{
    public function processPayment($amount, array $data, array $config)
    {
        // TODO: Implement processPayment() method.
    }
}