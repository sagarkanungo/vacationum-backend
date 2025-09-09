<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model {
    protected $fillable = [
        'airline_id','flight_number','origin_airport_id','destination_airport_id',
        'departure_at','arrival_at','price','duration_minutes','stops','equipment',
        'terminal_from','terminal_to','baggage_info'
    ];

    public function airline(){ return $this->belongsTo(Airline::class); }
    public function originAirport(){ return $this->belongsTo(Airport::class,'origin_airport_id'); }
    public function destinationAirport(){ return $this->belongsTo(Airport::class,'destination_airport_id'); }
    public function fares(){ return $this->hasMany(Fare::class); }
}
