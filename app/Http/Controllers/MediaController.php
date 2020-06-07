<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Episode;
use App\Models\Movie;
use App\Models\Season;
use App\Models\Show;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function book(Book $book)
    {

        return view('media.book', compact('book'));
    }
    public function movie(Movie $movie)
    {

        return view('media.movie', compact('movie'));
    }
    public function show(Show $show)
    {

        return view('media.show', compact('show'));
    }
    public function season(Show $show, Season $season)
    {

        return view('media.season', compact('season'));
    }
    public function episode(Show $show, Season $season, Episode $episode)
    {

        return view('media.episode', compact('episode'));
    }
}
