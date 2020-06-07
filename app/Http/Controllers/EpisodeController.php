<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index()
    {
        $episodes = Episodes::paginate(25);

        return view('episodes.index', compact('episodes'));
    }

    public function create()
    {
        return view('episodes.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Episode::create($data);

        echo json_encode(['success' => true]);
    }

    public function show(Episode $episode)
    {
        return view('episodes.show', compact('episode'));
    }

    public function edit(Episode $episode)
    {
        return view('episodes.edit', compact('episode'));
    }

    public function update(Request $request, Episode $episode)
    {
        $data = $request->all();

        $episode->update($data);

        echo json_encode(['success' => true]);
    }

    public function destroy(Episode $episode)
    {
        $episode->delete();

        echo json_encode(['success' => true]);
    }
}
