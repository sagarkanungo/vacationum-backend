<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // GET /api/products
    public function index()
    {
        return response()->json(Product::all());
    }

    // POST /api/products
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    // GET /api/products/{id}
    public function show(Product $product)
    {
        return response()->json($product);
    }

    // PUT /api/products/{id}
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    // DELETE /api/products/{id}
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(null, 204);
    }
}
