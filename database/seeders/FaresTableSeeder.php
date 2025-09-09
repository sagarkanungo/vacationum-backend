<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaresTableSeeder extends Seeder {
    public function run(): void {
        // fetch flights by number
        $f1 = DB::table('flights')->where('flight_number','AI2815')->value('id');
        $f2 = DB::table('flights')->where('flight_number','EK501')->value('id');
        $f3 = DB::table('flights')->where('flight_number','6E102')->value('id');

        DB::table('fares')->insertOrIgnore([
            ['flight_id'=>$f1,'cabin_class'=>'Economy','fare_code'=>'ECO1','fare_type'=>'Saver','price'=>8200.00,'seats_left'=>2,'refundable'=>false,'baggage'=>'15kg','created_at'=>now(),'updated_at'=>now()],
            ['flight_id'=>$f1,'cabin_class'=>'Economy','fare_code'=>'ECOF','fare_type'=>'Flex','price'=>10000.00,'seats_left'=>5,'refundable'=>true,'baggage'=>'20kg','created_at'=>now(),'updated_at'=>now()],
            ['flight_id'=>$f1,'cabin_class'=>'Business','fare_code'=>'BUS1','fare_type'=>'Standard','price'=>30000.00,'seats_left'=>3,'refundable'=>true,'baggage'=>'30kg','created_at'=>now(),'updated_at'=>now()],

            ['flight_id'=>$f2,'cabin_class'=>'Economy','fare_code'=>'ECO2','fare_type'=>'Saver','price'=>29500.00,'seats_left'=>4,'refundable'=>false,'baggage'=>'20kg','created_at'=>now(),'updated_at'=>now()],
            ['flight_id'=>$f3,'cabin_class'=>'Economy','fare_code'=>'ECO3','fare_type'=>'Saver','price'=>5400.00,'seats_left'=>6,'refundable'=>false,'baggage'=>'15kg','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
