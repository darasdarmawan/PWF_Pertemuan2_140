<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * tampilkan daftar todo milik user yang login
     */
   public function index()
    {
        try {
            $todos = Todo::where('user_id', Auth::id())->with('category')->get();
            return view('todo.index', compact('todos'));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    /**
     * tampilkan form buat todo baru
     */
    public function create()
    {
        // ambil category milik user untuk dropdown
        $categories = Category::where('user_id', Auth::id())->get();
        return view('todo.create', compact('categories'));
    }

    /**
     * simpan todo baru ke database
     */
    public function store(Request $request)
    {
        // validasi input
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Todo::create([
            'user_id'     => Auth::id(),
            'category_id' => $request->category_id,
            'title'       => $request->title,
            'is_done'     => false,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo created successfully.');
    }

    /**
     * tampilkan form edit todo
     */
    public function edit(Todo $todo)
    {
        // ambil category milik user untuk dropdown
        $categories = Category::where('user_id', Auth::id())->get();
        return view('todo.edit', compact('todo', 'categories'));
    }

    /**
     * update todo di database
     */
    public function update(Request $request, Todo $todo)
    {
        // validasi input
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $todo->update([
            'category_id' => $request->category_id,
            'title'       => $request->title,
        ]);

        return redirect()->route('todo.index')->with('success', 'Todo updated successfully.');
    }

    /**
     * tandai todo sebagai Complete
     */
    public function complete(Todo $todo)
    {
        $todo->update(['is_done' => true]);
        return redirect()->route('todo.index')->with('success', 'Todo marked as complete.');
    }

    /**
     * hapus todo dari database
     */
    public function destroy(Todo $todo)
    {
        $todo->delete();
        return redirect()->route('todo.index')->with('success', 'Todo deleted successfully.');
    }
}