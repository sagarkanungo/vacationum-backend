<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlinesTableSeeder extends Seeder {
    public function run(): void {
        DB::table('airlines')->insertOrIgnore([
            ['iata'=>'AI','icao'=>'AIC','name'=>'Air India','country'=>'India','created_at'=>now(),'updated_at'=>now()],
            ['iata'=>'6E','icao'=>'IGO','name'=>'IndiGo','country'=>'India','created_at'=>now(),'updated_at'=>now()],
            ['iata'=>'EK','icao'=>'UAE','name'=>'Emirates','country'=>'UAE','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
