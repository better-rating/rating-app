<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['rating' => function($query) {
            $query->where('user_id', auth()->user()->id);
        }])->paginate(25);

        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Movie::create($data);

        echo json_encode(['success' => true]);
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $data = $request->all();

        $movie->update($data);

        echo json_encode(['success' => true]);
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        echo json_encode(['success' => true]);
    }
}
