<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('Category')->get();

        return response()->json([
            'status' => 'success',
            'data' => $books
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
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|unique:books,isbn',
            'published_year' => 'required|string|min:100|max:' . date('Y'),
            'category_id' => 'required|exists:categires,id'
        ]);

        $book = Book::create($validated);

        $book->load('category');

        return response()->json([
            'status' => 'succes',
            'message' => 'Livre cree avec success',
            'data' => $book
        ],201);
    }

    /**
     * 
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'isbn' => 'sometimes|required|string|unique:books,isbn',
            'published_year' => 'sometimes|required|string|min:100|max:' . date('Y'),
            'category_id' => 'sometimes|required|exists:categires,id'
        ]);

        $book = Book::create($validated);

        $book->load('category');

        return response()->json([
            'status' => 'succes',
            'message' => 'Livre mise a jour',
            'data' => $book
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Livre supprimer'
        ]);
    }
}
