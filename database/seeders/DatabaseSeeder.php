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
                'client_id' => 'test_id',
                'client_secret' => 'test_secret',
            ],
            'stripe' => [
                'publishable_key' => 'test_pk',
                'secret_key' => 'test_sk',
            ],
            '2checkout' => [
                'merchant' => 'test_merchant',
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
