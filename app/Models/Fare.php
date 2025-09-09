<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model {
    protected $fillable = ['flight_id','cabin_class','fare_code','fare_type','price','seats_left','refundable','baggage','rules'];
    public function flight(){ return $this->belongsTo(Flight::class); }
    protected $casts = ['rules'=>'array'];
}
