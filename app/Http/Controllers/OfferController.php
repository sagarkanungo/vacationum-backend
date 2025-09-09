<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $query = Offer::query();

        // 🔹 Future filter logic (not active right now)
        if ($request->filled('journey_type')) {
            $query->where('journey_type', $request->journey_type);
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('bank')) {
            $query->where('bank', 'LIKE', "%{$request->bank}%");
        }

        if ($request->filled('active')) {
            $query->where('active', (bool) $request->active);
        }

        if ($request->filled('expires_before')) {
            $query->whereDate('expires_at', '<=', $request->expires_before);
        }

        // ✅ For now always return ALL offers, ignoring filters
        return response()->json(Offer::all());

        // 🚀 In future, just switch to:
        // return response()->json($query->get());
    }
}
