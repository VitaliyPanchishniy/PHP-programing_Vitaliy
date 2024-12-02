<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Валідація вхідних даних
        $validated = $request->validate([
            'title' => 'required|string|max:255',               // Обов’язкове поле, тип рядок, максимум 255 символів
            'description' => 'nullable|string',                // Необов’язкове поле, тип рядок
            'publication_year' => 'required|integer|digits:4', // Обов’язкове поле, тип число, рівно 4 цифри
            'price' => 'required|numeric|min:0',               // Обов’язкове поле, тип число, мінімум 0
            'author_id' => 'required|exists:authors,id',       // Обов’язкове поле, повинно бути id існуючого автора
            'genre_id' => 'required|exists:genres,id',         // Обов’язкове поле, повинно бути id існуючого жанру
        ]);

        // Якщо валідація пройшла, створюємо нову книгу
        $book = Book::create($validated);

        // Повертаємо відповідь з кодом 201 (Created)
        return response()->json($book, 201);
    }php artisan migrate


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
