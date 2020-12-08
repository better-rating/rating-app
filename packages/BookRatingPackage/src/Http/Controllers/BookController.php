<?php

namespace BetterRating\BookRatingPackage\Http\Controllers;

use BetterRating\BookRatingPackage\Models\Book;
use Carbon\Carbon;
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
        $modelClass = Book::class;
        $mediaManifest = [
            'type' => config('bookratingpackage.name'),
            'save_uri' => config('bookratingpackage.name_plural')
        ];
        return default_view('create', compact('modelClass', 'mediaManifest'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $columns = config('bookratingpackage.columns');

        $create = [];
        foreach ($data['fields'] as $col => $datum) {
            if ($columns[$col]['type'] === 'date') {
                $datum = Carbon::parse($datum);
            }
            $create[$columns[$col]['column']] = $datum;
        }

        $book = Book::create($create);

        echo json_encode(['success' => true, 'media' => $book]);
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
