<?php
namespace App\Services;

use App\Models\PaymentGateway;

class PaymentService
{
    public function processPayment($amount, array $data)
    {
        $gateway = PaymentGateway::where('is_active', 1)->firstOrFail();
        $config = json_decode($gateway->config, true);
        switch ($gateway->name) {
            case 'paypal':
                return(new PaypalPayment())->processPayment($amount, $data, $config);
            case 'razorpay':
                return(new RazorpayPayment)->processPayment($amount, $data, $config);
            case 'stripe':
                return(new StripePayment())->processPayment($amount, $data, $config);
            case 'sslcommerz':
                return(new SSLCommerzPayment())->processPayment($amount, $data, $config);
            default:
                throw new \Exception("Unsupported payment gateway");

        }
    }

    public function paymentView()
    {
        $gateway = PaymentGateway::where('is_active', 1)->firstOrFail();
        switch ($gateway->name) {
            case 'paypal':
                return view('payment.paypal');
            case 'razorpay':
                return view('payment.razorpay');
            case 'stripe':
                return view('payment.stripe');
            case 'sslcommerz':
                return view('payment.sslcommerz');
            default:
                throw new \Exception("Unsupported payment gateway");
        }
    }
}