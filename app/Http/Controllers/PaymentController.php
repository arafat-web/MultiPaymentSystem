<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\PaypalPayment;
use App\Services\StripePayment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;


    /**
     * Renders the payment view.
     *
     * This method is the action handler for the index route.
     * It instantiates a PaymentService object and
     * calls its paymentView method to render the payment view.
     *
     * @return mixed The rendered payment view.
     */
    public function index()
    {
        // Instantiate a new PaymentService object.
        $view = new PaymentService();

        // Call the paymentView method of the PaymentService object to render the payment view.
        // The method returns the rendered view.
        return $view->paymentView();
    }

    /**
     * Processes a payment request.
     *
     * @param Request $request The HTTP request object containing payment data.
     * @return mixed The result of the payment processing.
     */
    public function payment(Request $request)
    {
        // Instantiate the PaymentService class.
        $paymentService = new PaymentService();

        // Set the PaymentService instance as the current payment service.
        $this->paymentService = $paymentService;

        // Set the amount to be paid.
        $amount = 100;

        // Get all data from the HTTP request.
        $data = $request->all();

        // Process the payment using the current payment service.
        return $this->paymentService->processPayment($amount, $data);
    }
    /**
     * Handle the success of a payment.
     *
     * @param Request $request The HTTP request containing payment data.
     * @return mixed The result of the success handling.
     */
    public function paymentSuccess(Request $request)
    {
        // Instantiate the PaypalPayment class.
        $success = new PaypalPayment();

        // Call the paymentSuccess method of the PaypalPayment class,
        // passing the HTTP request as an argument and returning the result.
        return $success->paymentSuccess($request);
    }
    /**
     * Handles the cancellation of a payment.
     *
     * @return mixed The result of the cancellation handling.
     */
    public function paymentCancel()
    {
        // Instantiate the PaypalPayment class.
        $cancel = new PaypalPayment();

        // Call the paymentCancel method of the PaypalPayment class,
        // passing no arguments and returning the result.
        return $cancel->paymentCancel();
    }

    /**
     * Handle the success of a Stripe payment.
     *
     * This method instantiates a new StripePayment class and
     * calls its paymentSuccess method to handle the success of a Stripe payment.
     *
     * @return mixed The result of the success handling.
     */
    public function stripePaymentSuccess()
    {
        // Instantiate a new StripePayment class.
        $success = new StripePayment();

        // Call the paymentSuccess method of the StripePayment class to handle the success of a Stripe payment.
        // The method returns the result of the success handling.
        return $success->paymentSuccess();
    }
    /**
     * Handle the cancellation of a Stripe payment.
     *
     * This method instantiates a new StripePayment class and
     * calls its paymentCancel method to handle the cancellation of a Stripe payment.
     *
     * @return mixed The result of the cancellation handling.
     */
    public function stripePaymentCancel()
    {
        // Instantiate a new StripePayment class.
        $cancel = new StripePayment();

        // Call the paymentCancel method of the StripePayment class to handle the cancellation of a Stripe payment.
        // The method returns the result of the cancellation handling.
        return $cancel->paymentCancel();
    }

}
