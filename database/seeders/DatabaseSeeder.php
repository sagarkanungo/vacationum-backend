<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $this->call([
            AirportsTableSeeder::class,
            AirlinesTableSeeder::class,
            FlightsTableSeeder::class,
            FaresTableSeeder::class,
        ]);
    }
}
