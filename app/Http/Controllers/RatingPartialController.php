<?php

namespace App\Http\Controllers;

use App\Models\RatingPartial;
use Illuminate\Http\Request;

class RatingPartialController extends Controller
{
    public function index()
    {
        $ratingPartials = RatingPartial::paginate(25);

        return view('rating-partials.index', compact('ratingPartials'));
    }

    public function create()
    {
        return view('rating-partials.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        RatingPartial::create($data);

        echo json_encode(['success' => true]);
    }

    public function edit(RatingPartial $ratingPartial)
    {
        return view('rating-partials.edit', compact('ratingPartial'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
