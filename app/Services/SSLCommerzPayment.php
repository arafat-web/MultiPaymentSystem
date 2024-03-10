<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;

class SSLCommerzPayment implements PaymentGatewayInterface
{
    public function processPayment($amount, array $data, array $config)
    {
        // TODO: Implement processPayment() method.
    }
}