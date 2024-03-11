<?php
namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use Illuminate\Http\Request;

class AamarPayment implements PaymentGatewayInterface
{
    /**
     * Process the payment using Aamar Payment Gateway.
     *
     * @param float $amount The amount to be paid.
     * @param array $data Additional data for the payment.
     * @param array $config Configuration for the payment.
     */
    public function processPayment($amount, array $data, array $config)
    {
        // Generate a unique transaction ID
        $tran_id = uniqid();

        // Set the currency to use (BDT for Bangladeshi Taka)
        $currency = "BDT";

        // Store ID provided by Aamar Payment
        $store_id = "aamarpaytest";

        // Signature key provided by Aamar Payment
        $signature_key = "dbb74894e82415a2f7ff0ec3a97e4183";

        // URL to send the payment request
        $url = "https://sandbox.aamarpay.com/jsonpost.php";

        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array(
            $curl,
            array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_POSTFIELDS => '{' .
                    '"store_id": "' . $store_id . '",' .
                    '"tran_id": "' . $tran_id . '",' .
                    '"success_url": "' . route('success') . '",' .
                    '"fail_url": "' . route('fail') . '",' .
                    '"cancel_url": "' . route('cancel') . '",' .
                    '"amount": "' . $amount . '",' .
                    '"currency": "' . $currency . '",' .
                    '"signature_key": "' . $signature_key . '",' .
                    '"desc": "Merchant Registration Payment",' .
                    '"cus_name": "Name",' .
                    '"cus_email": "payer@merchantcusomter.com",' .
                    '"cus_add1": "House B-158 Road 22",' .
                    '"cus_add2": "Mohakhali DOHS",' .
                    '"cus_city": "Dhaka",' .
                    '"cus_state": "Dhaka",' .
                    '"cus_postcode": "1206",' .
                    '"cus_country": "Bangladesh",' .
                    '"cus_phone": "+8801704",' .
                    '"type": "json"' .
                    '}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            )
        );

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Close the cURL session
        curl_close($curl);

        // Decode the JSON response
        $responseObj = json_decode($response);

        // If a payment URL is returned, redirect the user to it
        if (isset($responseObj->payment_url) && !empty($responseObj->payment_url)) {

            $paymentUrl = $responseObj->payment_url;
            return redirect()->away($paymentUrl);

        } else {
            // Otherwise, echo the response
            echo $response;
        }

    }

    /**
     * Handle the success response from Aamar Payment Gateway.
     *
     * @param Request $request The HTTP request object.
     * @return void
     */
    public function success(Request $request)
    {
        // Extract the transaction ID from the request
        $request_id = $request->mer_txnid;

        // Construct the URL to check the transaction status
        $url = "http://sandbox.aamarpay.com/api/v1/trxcheck/request.php"
            . "?request_id=$request_id"
            . "&store_id=aamarpaytest"
            . "&signature_key=dbb74894e82415a2f7ff0ec3a97e4183"
            . "&type=json";

        // Initialize cURL
        $curl = curl_init();

        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        )
        );

        // Execute the cURL request and get the response
        $response = curl_exec($curl);

        // Close the cURL session
        curl_close($curl);

        // Output the response
        echo $response;
    }

    /**
     * Handle the fail response from Aamar Payment Gateway.
     *
     * @param Request $request The HTTP request object containing the failed transaction details.
     * @return Request The HTTP request object.
     */
    public function fail(Request $request)
    {
        // Handle the fail response from Aamar Payment Gateway.
        // This function will be called when the payment transaction fails.
        // It returns the HTTP request object containing the failed transaction details.

        return $request;
    }


    /**
     * Handle the cancel response from Aamar Payment Gateway.
     *
     * This function will be called when the payment transaction is canceled.
     * It returns a string 'Canceled' indicating that the transaction was canceled.
     *
     * @return string The string 'Canceled' indicating that the transaction was canceled.
     */
    public function cancel()
    {
        // Handle the cancel response from Aamar Payment Gateway.
        // This function will be called when the payment transaction is canceled.
        // It returns a string 'Canceled' indicating that the transaction was canceled.
        return 'Canceled';
    }
}