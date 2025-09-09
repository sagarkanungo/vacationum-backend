<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;
use App\Models\Airport;
use Illuminate\Support\Facades\Log;

class FlightController extends Controller
{
    public function search(Request $request)
    {
        Log::info('Payload:', $request->all());

        $tripType = $request->input('trip_type', 'oneway');
        $segments = [];

        switch ($tripType) {
            case 'oneway':
                $segments[] = [
                    'from' => $request->input('from'),
                    'to' => $request->input('to'),
                    'date' => $request->input('date'),
                ];
                break;

            case 'roundtrip':
                $segments[] = [
                    'from' => $request->input('from'),
                    'to' => $request->input('to'),
                    'date' => $request->input('depart_date'),
                ];
                $segments[] = [
                    'from' => $request->input('to'),
                    'to' => $request->input('from'),
                    'date' => $request->input('return_date'),
                ];
                break;

            case 'multicity':
                $segments = $request->input('segments', []);
                break;

            case 'roundtrip-combined':
                return $this->searchRoundtripCombined($request);

            default:
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid trip_type'
                ], 422);
        }

        // ✅ Fetch flights for each segment
        $resultSegments = [];
        foreach ($segments as $seg) {
            $resultSegments[] = $this->getFlightsForSegment($seg, $request);
        }

        return response()->json([
            'success' => true,
            'trip_type' => $tripType,
            'segments' => $resultSegments
        ]);
    }

    private function getFlightsForSegment($seg, Request $request)
    {
        $from = isset($seg['from']) ? strtoupper($seg['from']) : null;
        $to   = isset($seg['to']) ? strtoupper($seg['to']) : null;
        $date = $seg['date'] ?? null;

        $query = Flight::with(['airline', 'originAirport', 'destinationAirport', 'fares']);

        if ($from) {
            $originId = Airport::where('iata', $from)->value('id');
            if ($originId) {
                $query->where('origin_airport_id', $originId);
            }
        }

        if ($to) {
            $destinationId = Airport::where('iata', $to)->value('id');
            if ($destinationId) {
                $query->where('destination_airport_id', $destinationId);
            }
        }

        if ($date) {
            $query->whereDate('departure_at', $date);
        }

        // ✅ Pagination (default 10 per page)
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $flights = $query->orderBy('departure_at')
            ->paginate($perPage, ['*'], 'page', $page);

        return [
            'from' => $from,
            'to' => $to,
            'date' => $date,
            'flights' => $flights->getCollection()->map(fn($f) => $this->formatFlight($f))->values(),
            'pagination' => [
                'current_page' => $flights->currentPage(),
                'last_page' => $flights->lastPage(),
                'per_page' => $flights->perPage(),
                'total' => $flights->total(),
            ]
        ];
    }

    private function formatFlight($f)
    {
        return [
            'id' => $f->id,
            'uuid' => $f->uuid, 
            'flight_number' => $f->flight_number,
            'airline' => $f->airline?->name,
            'airline_iata' => $f->airline?->iata,
            'origin' => [
                'iata' => $f->originAirport->iata,
                'city' => $f->originAirport->city,
                'terminal' => $f->terminal_from ?? null
            ],
            'destination' => [
                'iata' => $f->destinationAirport->iata,
                'city' => $f->destinationAirport->city,
                'terminal' => $f->terminal_to ?? null
            ],
            'departure_at' => $f->departure_at,
            'arrival_at' => $f->arrival_at,
            'duration_minutes' => $f->duration_minutes,
            'stops' => $f->stops,
            'equipment' => $f->equipment,
            'price' => $f->price,
            'partially_refundable' => $f->partially_refundable ?? false,
            'fares' => $f->fares->map(fn($fare) => [
                'id' => $fare->id,
                'cabin_class' => $fare->cabin_class,
                'fare_code' => $fare->fare_code,
                'fare_type' => $fare->fare_type,
                'price' => $fare->price,
                'seats_left' => $fare->seats_left,
                'refundable' => $fare->refundable,
                'baggage' => $fare->baggage,
            ]),
            'seats' => json_decode($f->seats),
            'meals' => json_decode($f->meals),
        ];
    }

    private function searchRoundtripCombined(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Roundtrip combined not implemented yet'
        ]);
    }
}
