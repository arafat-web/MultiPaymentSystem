<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;


    public function index()
    {
        return view('welcome');
    }

    public function processPayment(Request $request)
    {
        $paymentService = new PaymentService();
        $this->paymentService = $paymentService;
        $amount = 100;
        $data = [
            'name' => $request->name,
            'email' => $request->email
        ];
        return $this->paymentService->processPayment($amount, $data);
    }
}
