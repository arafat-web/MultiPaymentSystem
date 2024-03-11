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
        $gateways = [
            'paypal' => [
                'mode' => 'sandbox',
                'client_id' => 'AdIm__wXnoq3THz55M5mgEWWyNZVQHF1mNWtrJPz5togtRLfZbfExq7fcPyxzGGk9-9IC1d_lLZYRO2H',
                'client_secret' => 'EH-ZMtMC7Kn7RNxEHURHFAxud2Z2iyR20TQsAzUGrhPoeOlvb4HZj4UEQRvMTl8uMlnnnGy--Rvo5PKs',
            ],
            'stripe' => [
                'publishable_key' => 'pk_test_51OU2r2KdjtJ0K09AnX8tNZGPSpTzJjd9hbWZ6iOwRru2LMbRSpdZJ8XWic5CPl2ps5wnGx7Wspr1pNMsUL7JadKg00MnWTpw12',
                'secret_key' => 'sk_test_51OU2r2KdjtJ0K09AajdztowtylB7pAXRdqsi2aFHNXqO1HEaR7a33YUZiHAOFTT1zoXDP9cca33JYCY7Q8K0bUSW00fd1XVpj4',
            ],
            '2checkout' => [
                'merchant' => '254928155937',
                'currency' => 'USD',
            ],
            'aamarpay' => [
                'store_id' => 'aamarpaytest',
                'signature_key' => 'dbb74894e82415a2f7ff0ec3a97e4183',
                'currency' => 'BDT',
            ],
        ];

        foreach ($gateways as $name => $config) {
            PaymentGateway::create([
                'name' => $name,
                'config' => json_encode($config),
                'type' => 'test',
                'is_active' => true,
            ]);
        }
    }
}
