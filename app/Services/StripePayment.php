<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Stripe\Stripe;

class StripePayment implements PaymentGatewayInterface
{
    public function processPayment($amount, array $data, array $config)
    {
        Stripe::setApiKey($config['secret_key']);
        header('Content-Type: application/json');
        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $data['product'],
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ]
            ],
            'mode' => 'payment',
            'success_url' => route('stripe.payment.success'),
            'cancel_url' => route('stripe.payment.cancel'),
        ]);
        header("HTTP/1.1 303 See Other");
        header("Location: " . $checkout_session->url);
    }

    public function paymentSuccess()
    {
        return view('payment.stripe.stripe')->with('success', 'Payment Successful');
    }

    public function paymentCancel()
    {
        return view('payment.stripe.stripe')->with('error', 'Payment Canceled');
    }

}