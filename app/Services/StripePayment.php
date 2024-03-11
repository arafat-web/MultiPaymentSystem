<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Stripe\Stripe;

class StripePayment implements PaymentGatewayInterface
{
    public function processPayment($amount, array $data, array $config)
    {
        $data['product'] = [
            "product" => "Stubborn Attachments",
            "price" => "20.00",
            "images" => "https://i.imgur.com/EHyR2nP.png"
        ];
        Stripe::setApiKey($config['secret_key']);
        $session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => ['name' => $data['product']['product']],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.payment.success'),
            'cancel_url' => route('stripe.payment.cancel'),
        ], ['api_key' => $config['secret_key']]);
        header("Location: {$session->url}");
        http_response_code(303);
    }
    public function paymentSuccess()
    {
        return to_route('index')->with('success', 'Payment Successful');
    }

    public function paymentCancel()
    {
        return to_route('index')->with('error', 'Payment Canceled');
    }

}