<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * tampilkan daftar category milik user yang login
     */
    public function index()
    {
        // withcount agar bisa hitung jumlah todo per category
        $categories = Category::where('user_id', Auth::id())
                        ->withCount('todos')
                        ->get();
        return view('category.index', compact('categories'));
    }

    /**
     * tampilkan form buat category baru
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * simpan category baru ke database
     */
    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Category::create([
            'user_id' => Auth::id(),
            'title'   => $request->title,
        ]);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }
    /**
     * tampilkan form edit category
     */
    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    /**
     * update category di database
     */
    public function update(Request $request, Category $category)
    {
        // validasi input
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $category->update(['title' => $request->title]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * hapus category dari database
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}