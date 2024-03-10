<?php

use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/pay', [PaymentController::class, 'index'])->name('payment.index');

// Paypal
Route::get('/payment', [PaymentController::class, 'payment'])->name('payment');
Route::get('paypal/payment/success', [PaymentController::class, 'paymentSuccess'])->name('paypal.payment.success');
Route::get('paypal/payment/cancel', [PaymentController::class, 'paymentCancel'])->name('paypal.payment/cancel');


// Stripe
Route::get('stripe/payment/success', [PaymentController::class, 'stripePaymentSuccess'])->name('stripe.payment.success');
Route::get('stripe/payment/cancel', [PaymentController::class, 'stripePaymentCancel'])->name('stripe.payment.cancel');

