<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPayment implements PaymentGatewayInterface
{
    public $configSuccess;
    public function processPayment($amount, array $data, array $configInput)
    {
        $config = [
            "mode" => $configInput['mode'],
            "sandbox" => [
                "client_id" => $configInput['client_id'],
                "client_secret" => $configInput['client_secret'],
                "app_id" => "APP-80W284485P519543T"
            ],
            "live" => [
                "client_id" => "",
                "client_secret" => "",
                "app_id" => "",
            ],
            "payment_action" => "Sale",
            "currency" => "USD",
            "notify_url" => "",
            "locale" => "en_US",
            "validate_ssl" => true
        ];


        $provider = new PayPalClient();
        $provider->setApiCredentials($config);
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('paypal.payment.success'),
                "cancel_url" => route('paypal.payment/cancel'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "100.00"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');

        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

    }


    public function paymentCancel()
    {
        return redirect()
            ->route('paypal')
            ->with('error', 'You have canceled the transaction.');
    }


    public function paymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config($this->configSuccess));
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('paypal')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('paypal')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}