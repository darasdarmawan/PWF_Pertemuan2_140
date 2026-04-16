<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Gate;
use Illuminate\Database\QueryException; 
use Illuminate\Support\Facades\Log;     

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty' => 'required|integer', 
            'price' => 'required|numeric',
        ], [
            'name.required' => 'Nama produk wajib diisi.',
            'name.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'qty.required' => 'Jumlah (kuantitas) produk wajib diisi.',
            'qty.integer' => 'Jumlah produk harus berupa angka bulat (tidak boleh desimal).',
            'price.required' => 'Harga produk wajib diisi.',
            'price.numeric' => 'Harga produk harus berupa angka yang valid.',
        ]);

        $validated['user_id'] = Auth::id(); 


        try {
            Product::create($validated);

            return redirect()
                ->route('product.index')
                ->with('success', 'Product created successfully.');

        } catch (QueryException $e) {
            Log::error('Product store database error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Database error while creating product.');

        } catch (\Throwable $e) {
            Log::error('Product store unexpected error', [
                'message' => $e->getMessage(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Unexpected error occurred.');
        }
    }

    public function show(Product $product)
    {
        return view('product.view', compact('product'));
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        Gate::authorize('update', $product);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'qty'  => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        $product->update($validated);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }
    public function delete(Product $product)
    {
        Gate::authorize('delete', $product);
        $product->delete();
        
        return redirect()->route('product.index')->with('success', 'Product berhasil dihapus');
    }
}