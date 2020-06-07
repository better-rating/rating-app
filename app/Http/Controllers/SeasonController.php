<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index()
    {
        $seasons = Seasons::paginate(25);

        return view('seasons.index', compact('seasons'));
    }

    public function create()
    {
        return view('seasons.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Season::create($data);

        echo json_encode(['success' => true]);
    }

    public function show(Season $season)
    {
        return view('seasons.show', compact('season'));
    }

    public function edit(Season $season)
    {
        return view('seasons.edit', compact('season'));
    }

    public function update(Request $request, Season $season)
    {
        $data = $request->all();

        $season->update($data);

        echo json_encode(['success' => true]);
    }

    public function destroy(Season $season)
    {
        $season->delete();

        echo json_encode(['success' => true]);
    }
}
