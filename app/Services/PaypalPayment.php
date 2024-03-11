<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalPayment implements PaymentGatewayInterface
{
    public $configSuccess;
    public function processPayment($amount, array $data,  array $configInput)
    {
    //    dd($configInput);
        $config = [
            "mode" => $configInput['mode'],
            "sandbox" => [
                "client_id" => $configInput['client_id'],
                "client_secret" => $configInput['client_secret'],
                "app_id" => "APP-80W284485P519543T"
            ],
            "live" => [
                "client_id" => $configInput['client_id'],
                "client_secret" => $configInput['client_secret'],
                "app_id" => "APP-80W284485P519543T"
            ],
            "payment_action" => "Sale",
            "currency" => "USD",
            "notify_url" => "",
            "locale" => "en_US",
            "validate_ssl" => true
        ];
        $this->configSuccess = $config;
        session(['configSuccess' => $this->configSuccess]);

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
                ->route('index')
                ->with('error', 'Something went wrong.');

        } else {
            dd($response);
        }

    }


    public function paymentCancel()
    {
        return redirect()
            ->route('index')
            ->with('error', 'You have canceled the transaction.');
    }


    public function paymentSuccess(Request $request)
    {
        $this->configSuccess = session('configSuccess');
        $provider = new PayPalClient;
        $provider->setApiCredentials($this->configSuccess);
        $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()
                ->route('index')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('index')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}