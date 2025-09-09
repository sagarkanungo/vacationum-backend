<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirportsTableSeeder extends Seeder {
    public function run(): void {
        DB::table('airports')->insertOrIgnore([
            ['iata'=>'DEL','icao'=>'VIDP','name'=>'Indira Gandhi Intl','city'=>'New Delhi','country'=>'India','timezone'=>'Asia/Kolkata','latitude'=>28.5562,'longitude'=>77.1000,'created_at'=>now(),'updated_at'=>now()],
            ['iata'=>'BOM','icao'=>'VABB','name'=>'Chhatrapati Shivaji Intl','city'=>'Mumbai','country'=>'India','timezone'=>'Asia/Kolkata','latitude'=>19.0896,'longitude'=>72.8656,'created_at'=>now(),'updated_at'=>now()],
            ['iata'=>'BLR','icao'=>'VOBL','name'=>'Kempegowda Intl','city'=>'Bengaluru','country'=>'India','timezone'=>'Asia/Kolkata','latitude'=>13.1986,'longitude'=>77.7066,'created_at'=>now(),'updated_at'=>now()],
            ['iata'=>'DXB','icao'=>'OMDB','name'=>'Dubai Intl','city'=>'Dubai','country'=>'UAE','timezone'=>'Asia/Dubai','latitude'=>25.2528,'longitude'=>55.3644,'created_at'=>now(),'updated_at'=>now()],
            ['iata'=>'JFK','icao'=>'KJFK','name'=>'John F. Kennedy Intl','city'=>'New York','country'=>'USA','timezone'=>'America/New_York','latitude'=>40.6413,'longitude'=>-73.7781,'created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
