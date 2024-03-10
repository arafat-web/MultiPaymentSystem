<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\PaymentGateway;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Correct the JSON string by enclosing it in single quotes and making sure it's valid
        $paypal = [
            // "mode" => "sandbox",
            // "client_id" => "AdIm__wXnoq3THz55M5mgEWWyNZVQHF1mNWtrJPz5togtRLfZbfExq7fcPyxzGGk9-9IC1d_lLZYRO2H",
            // "client_secret" => "EH-ZMtMC7Kn7RNxEHURHFAxud2Z2iyR20TQsAzUGrhPoeOlvb4HZj4UEQRvMTl8uMlnnnGy--Rvo5PKs"
        ];

        PaymentGateway::create([
            'name' => 'paypal',
            'config' => json_encode($paypal),
            'type' => 'sandbox',
            'is_active' => false,
        ]);

        $stripe = [
            // "publishable_key" => "pk_test_51OU2r2KdjtJ0K09AnX8tNZGPSpTzJjd9hbWZ6iOwRru2LMbRSpdZJ8XWic5CPl2ps5wnGx7Wspr1pNMsUL7JadKg00MnWTpw12",
            // "secret_key" => "sk_test_51OU2r2KdjtJ0K09AajdztowtylB7pAXRdqsi2aFHNXqO1HEaR7a33YUZiHAOFTT1zoXDP9cca33JYCY7Q8K0bUSW00fd1XVpj4",
        ];

        PaymentGateway::create([
            'name' => 'stripe',
            'config' => json_encode($stripe),
            'type' => 'test',
            'is_active' => true,
        ]);

        $twoCheckout = [
            "merchant" => "test",
        ];

        PaymentGateway::create([
            'name' => '2checkout',
            'config' => json_encode($twoCheckout),
            'type' => 'test',
            'is_active' => true,
        ]);

        $sslCommerz = [
            "store_id" => "test",
            "store_password" => "test",
        ];

        PaymentGateway::create([
            'name' => 'sslcommerz',
            'config' => json_encode($sslCommerz),
            'type' => 'test',
            'is_active' => true,
        ]);

    }
}
