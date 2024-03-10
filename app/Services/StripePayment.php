<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;

class StripePayment implements PaymentGatewayInterface
{
    public function processPayment($amount, array $data, array $config)
    {
        // TODO: Implement processPayment() method.
    }
}