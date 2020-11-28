<?php

namespace BetterRating\BookRatingPackage\Http\Controllers;

use BetterRating\BookRatingPackage\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class BookController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $books = Book::paginate(25);

        return default_view('index', compact('books'));
    }

    public function create()
    {
        return default_view('create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Book::create($data);

        echo json_encode(['success' => true]);
    }

    public function show(Book $book)
    {
        return default_view('show', compact('book'));
    }

    public function edit(Book $book)
    {
        return default_view('edit', compact('book'));
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
