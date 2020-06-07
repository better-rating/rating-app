<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::paginate(25);

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Book::create($data);

        echo json_encode(['success' => true]);
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->all();

        $book->update($data);

        echo json_encode(['success' => true]);
    }

    public function destroy(Book $book)
    {
        $book->delete();

        echo json_encode(['success' => true]);
    }
}
