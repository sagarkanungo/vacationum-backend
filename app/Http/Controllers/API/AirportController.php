<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Airport;

class AirportController extends Controller {
    public function index(Request $request){
        $q = $request->query('q');
        $query = Airport::query();
        if($q){
            $q = strtoupper($q);
            $query->where('iata', 'like', "%{$q}%")
                  ->orWhere('name', 'like', "%{$q}%")
                  ->orWhere('city', 'like', "%{$q}%");
        }
        $results = $query->limit(20)->get(['id','iata','name','city','country']);
        return response()->json(['success'=>true,'data'=>$results]);
    }
}
