<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Airline extends Model {
    protected $fillable = ['iata','icao','name','country'];
}
