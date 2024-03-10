<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;

class TwoCheckoutPayment implements PaymentGatewayInterface
{
    public function processPayment($amount, array $data, array $config)
    {
        // TODO: Implement processPayment() method.
        $url = "https://secure.2checkout.com/checkout/buy?merchant=" . $config['merchant'] . "&currency=USD&tpl=one-column&dynamic=1&prod=" . $data['product'] . "&price=" . $amount . "&type=digital&qty=" . $data['quantity'] . "&signature=2e484be365bd77cd79d8759a3507feaf6ea3af6fee44a3c682dbddd17ee929bb";

        return url($url);
    }
}