<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Airline;

class AirlineController extends Controller {
    public function index(){
        $airlines = Airline::all(['id','iata','name']);
        return response()->json(['success'=>true,'data'=>$airlines]);
    }
}
