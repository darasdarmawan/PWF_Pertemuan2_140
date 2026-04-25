<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar category beserta total product
     */
    public function index()
    {
        // withCount agar bisa hitung total product per category
        $categories = Category::withCount('products')->get();
        return view('category.index', compact('categories'));
    }

    /**
     * Tampilkan form tambah category baru
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Simpan category baru ke database
     */
    public function store(Request $request)
    {
        // Validasi: name wajib diisi dan harus unik
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name',
        ]);

        Category::create(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Tampilkan form edit category
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * Update category di database
     */
    public function update(Request $request, Category $category)
    {
        // Validasi: name wajib dan unik kecuali milik sendiri
        $request->validate([
            'name' => 'required|string|max:255|unique:category,name,' . $category->id,
        ]);

        $category->update(['name' => $request->name]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Hapus category dari database
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}