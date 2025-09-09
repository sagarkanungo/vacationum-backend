<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OffersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('offers')->insert([
            [
                'title' => 'Interest FREE EMI + Up to 35% OFF',
                'description' => 'Avail Interest FREE* EMI + Up to 35% OFF on flights, stays & holiday packages for your trips in India & abroad!',
                'code' => null,
                'journey_type' => 'domestic',
                'category' => 'flight',
                'bank' => null,
                'expires_at' => '2025-04-05',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '10% Instant Discount using HDFC Card',
                'description' => 'Upto 10% instant discount using HDFC Card on flights, stays & holiday packages for your trips in India & abroad!',
                'code' => 'SAVE20',
                'journey_type' => 'international',
                'category' => 'bank',
                'bank' => 'HDFC',
                'expires_at' => '2025-04-05',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Special Festival Offer',
                'description' => 'Book flights during this festive season and get flat 20% OFF.',
                'code' => 'FEST20',
                'journey_type' => 'domestic',
                'category' => 'special',
                'bank' => null,
                'expires_at' => '2025-04-10',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SBI Bank Flight Offer',
                'description' => 'Get 15% discount on flight bookings using SBI credit cards.',
                'code' => 'SBI15',
                'journey_type' => 'international',
                'category' => 'bank',
                'bank' => 'SBI',
                'expires_at' => '2025-04-12',
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
