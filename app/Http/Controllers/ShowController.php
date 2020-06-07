<?php

namespace App\Http\Controllers;

use App\Models\Show;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index()
    {
        $shows = Shows::paginate(25);

        return view('shows.index', compact('shows'));
    }

    public function create()
    {
        return view('shows.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Show::create($data);

        echo json_encode(['success' => true]);
    }

    public function show(Show $show)
    {
        return view('shows.show', compact('show'));
    }

    public function edit(Show $show)
    {
        return view('shows.edit', compact('show'));
    }

    public function update(Request $request, Show $show)
    {
        $data = $request->all();

        $show->update($data);

        echo json_encode(['success' => true]);
    }

    public function destroy(Show $show)
    {
        $show->delete();

        echo json_encode(['success' => true]);
    }
}
