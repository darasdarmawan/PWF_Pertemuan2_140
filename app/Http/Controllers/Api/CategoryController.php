<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
   
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'message' => 'Berhasil mengambil data kategori',
            'data'    => $categories,
        ], 200);
    }

    public function show(int $id)
    {
        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
        }
        return response()->json([
            'message' => 'OK',
            'data'    => $category,
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $category = Category::create($validated);
            Log::info('Kategori berhasil ditambahkan', ['data' => $category]);

            return response()->json([
                'message' => 'Kategori berhasil ditambahkan',
                'data'    => $category,
            ], 201);
        } catch (\Throwable $e) {
            Log::error('Error saat store kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }


    public function update(Request $request, int $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
            ]);

            $category->update($validated);

            return response()->json([
                'message' => 'Kategori berhasil diupdate',
                'data'    => $category,
            ], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat update kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }


    public function destroy(int $id)
    {
        try {
            $category = Category::find($id);
            if (!$category) {
                return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
            }

            $category->delete();

            return response()->json(['message' => 'Kategori berhasil dihapus'], 200);
        } catch (\Throwable $e) {
            Log::error('Error saat delete kategori', ['message' => $e->getMessage()]);
            return response()->json(['message' => 'Terjadi kesalahan server'], 500);
        }
    }
}