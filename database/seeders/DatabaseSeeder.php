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

        PaymentGateway::create([
            'name' => 'paypal',
            'config' => '{"mode": "sandbox", "client_id": "EH-ZMtMC7Kn7RNxEHURHFAxud2Z2iyR20TQsAzUGrhPoeOlvb4HZj4UEQRvMTl8uMlnnnGy--Rvo5PKs", "client_secret": "EH-ZMtMC7Kn7RNxEHURHFAxud2Z2iyR20TQsAzUGrhPoeOlvb4HZj4UEQRvMTl8uMlnnnGy--Rvo5PKs"}',
            'type' => 'sandbox',
            'is_active' => 1,
        ]);
    }
}
