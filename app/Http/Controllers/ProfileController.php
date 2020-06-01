<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\RatingPartial;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::paginate(25);

        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        $ratingPartials = RatingPartial::all();

        return view('profiles.create', compact('ratingPartials'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $profile = Profile::create([
            'name' => $data['name'],
            'media_type' => $data['media_type'],
        ]);

        $profile->rating_partials()->attach($data['rating_partials']);

        echo json_encode(['success' => true, 'id' => $profile->hashid]);
    }

    public function show(Profile $profile)
    {
        $profile->load('rating_partials');

        return view('profiles.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        $ratingPartials = RatingPartial::all();
        $profile->load('rating_partials');

        return view('profiles.edit', compact('profile', 'ratingPartials'));
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
