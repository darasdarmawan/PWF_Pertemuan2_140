<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json(['message' => 'OK', 'data' => $products], 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'qty'         => 'required|integer',
                'price'       => 'required|numeric',
                'category_id' => 'nullable|exists:category,id',
            ]);
            $validated['user_id'] = Auth::id();
            $product = Product::create($validated);
            Log::info('Menambah data produk', ['list' => $product]);
            return response()->json(['message' => 'Produk berhasil ditambahkan', 'data' => $product], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat menambah product', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function show(int $id)
    {
        try {
            $product = Product::with('category')->find($id);
            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }
            return response()->json(['message' => 'OK', 'data' => $product], 200);
        } catch (\Throwable $e) {
            Log::error('Gagal mengambil data produk', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function update(Request $request, int $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }
            $validated = $request->validate([
                'name'        => 'sometimes|string|max:255',
                'qty'         => 'sometimes|integer',
                'price'       => 'sometimes|numeric',
                'category_id' => 'nullable|exists:category,id',
            ]);
            $product->update($validated);
            return response()->json(['message' => 'Produk berhasil diupdate', 'data' => $product], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update product', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }

    public function destroy(int $id)
    {
        try {
            $product = Product::find($id);
            if (!$product) {
                return response()->json(['message' => 'Product tidak ditemukan'], 404);
            }
            $product->delete();
            return response()->json(['message' => 'Produk berhasil dihapus'], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat delete product', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }
}