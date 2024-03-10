<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\PaypalPayment;
use App\Services\StripePayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;


    public function index()
    {
        $view = new PaymentService();
        return $view->paymentView();
    }

    public function payment(Request $request)
    {
        
        $paymentService = new PaymentService();
        $this->paymentService = $paymentService;
        $amount = 100;
        $data = $request->all();
        return $this->paymentService->processPayment($amount, $data);
    }

    public function paymentSuccess(Request $request)
    {
        $success = new PaypalPayment();
        return $success->paymentSuccess($request);
    }

    public function paymentCancel()
    {
        $cancel = new PaypalPayment();
        return $cancel->paymentCancel();
    }

    public function stripePaymentSuccess()
    {
        $success = new StripePayment();
        return $success->paymentSuccess();
    }

    public function stripePaymentCancel()
    {
        $cancel = new StripePayment();
        return $cancel->paymentCancel();
    }
}
