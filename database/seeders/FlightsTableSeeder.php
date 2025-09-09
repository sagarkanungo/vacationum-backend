<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FlightsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Resolve airport IDs
        $del = DB::table('airports')->where('iata', 'DEL')->value('id');
        $dxb = DB::table('airports')->where('iata', 'DXB')->value('id');
        $bom = DB::table('airports')->where('iata', 'BOM')->value('id');
        $blr = DB::table('airports')->where('iata', 'BLR')->value('id');
        $jfk = DB::table('airports')->where('iata', 'JFK')->value('id');
        $lhr = DB::table('airports')->where('iata', 'LHR')->value('id');

        // Resolve airline IDs
        $ai = DB::table('airlines')->where('iata', 'AI')->value('id');
        $ek = DB::table('airlines')->where('iata', 'EK')->value('id');
        $ind = DB::table('airlines')->where('iata', '6E')->value('id');

        $flights = [];

        for ($i = 1; $i <= 50; $i++) {
            $origin = [$del, $dxb, $bom, $blr][array_rand([0,1,2,3])];
            $destination = [$dxb, $del, $lhr, $jfk][array_rand([0,1,2,3])];

            // Ensure origin != destination
            if ($origin === $destination) {
                $destination = $del;
            }

            $airline = [$ai, $ek, $ind][array_rand([0,1,2])];
            $price = rand(5000, 50000);
            $duration = rand(90, 600);

            $flights[] = [
                'uuid' => Str::uuid(), // Unique identifier for React key
                'airline_id' => $airline,
                'flight_number' => 'FL' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'origin_airport_id' => $origin,
                'destination_airport_id' => $destination,
                'departure_at' => now()->addDays(rand(1, 15))->setTime(rand(0, 23), rand(0, 59)),
                'arrival_at' => now()->addDays(rand(1, 15))->setTime(rand(0, 23), rand(0, 59)),
                'price' => $price,
                'duration_minutes' => $duration,
                'stops' => rand(0, 1),
                'equipment' => ['A320', 'B777', 'A380'][array_rand([0,1,2])],
                'terminal_from' => 'T' . rand(1, 3),
                'terminal_to' => 'T' . rand(1, 5),
                'baggage_info' => json_encode(['cabin' => '7kg', 'checked' => rand(15, 30) . 'kg']),
                'seats' => json_encode([
                    ['row' => 1, 'seat' => 'A', 'status' => 'available', 'price' => 0],
                    ['row' => 1, 'seat' => 'B', 'status' => 'booked', 'price' => 0],
                    ['row' => 1, 'seat' => 'C', 'status' => 'available', 'price' => 20],
                ]),
                'meals' => json_encode([
                    ['name' => 'Standard', 'price' => 0],
                    ['name' => 'Vegetarian', 'price' => 20],
                    ['name' => 'Non-Veg', 'price' => 25],
                ]),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }

        DB::table('flights')->insertOrIgnore($flights);
    }
}
