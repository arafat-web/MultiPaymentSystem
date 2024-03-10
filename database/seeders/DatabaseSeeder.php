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
        $data = [
            "mode" => "sandbox",
            "client_id" => "AdIm__wXnoq3THz55M5mgEWWyNZVQHF1mNWtrJPz5togtRLfZbfExq7fcPyxzGGk9-9IC1d_lLZYRO2H",
            "client_secret" => "EH-ZMtMC7Kn7RNxEHURHFAxud2Z2iyR20TQsAzUGrhPoeOlvb4HZj4UEQRvMTl8uMlnnnGy--Rvo5PKs"
        ];

        PaymentGateway::create([
            'name' => 'paypal',
            'config' => json_encode($data),
            'type' => 'sandbox',
            'is_active' => 1,
        ]);

    }
}
