<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount('books')->get();
        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $category = Category::create($validated);
        return response()->json([
            'status' => 'success',
            'message' => 'Categorie cree avec success',
            'data' => $category
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load('books');
        return response()->json([
            'status' => 'success',
            'data' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $category->update($validated);


        return response()->json([
            'status' => 'success',
            'message' => 'Categorie mise a jour',
            'data' => $category
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Categorie supprimer avec success'
        ]);
    }

    public function books(Category $category){
        return response()->json([
            'status' => 'success',
            'data' => $category->books
        ]);
    }
}
