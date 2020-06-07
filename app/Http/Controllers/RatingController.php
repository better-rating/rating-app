<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Rating;
use App\Models\RatingPartial;
use App\Models\Review;
use Illuminate\Http\Request;
use Str;

class RatingController extends Controller
{
    public function index()
    {
        return view('ratings.index');
    }

    public function create($media_type, $media_slug)
    {
        $modelInstance = resolve("\\App\\Models\\".Str::studly($media_type));
        $media = $modelInstance->where('slug', $media_slug)->firstOrFail();

        return view('ratings.create', compact('media_type', 'media'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $rating = new Rating();

        $mediaInstance = resolve("\\App\\Models\\".Str::studly($data['media_type']));
        $media = $mediaInstance->retrieve($data['media_slug']);

        $rating->media_type = $data['media_type'];
        $rating->media_id = $media->id;
        $rating->score = 0;
        $rating->possible_score = 0;

        $reviews = [];
        foreach ($data['reviews'] as $review) {
            $ratingPartial = RatingPartial::findViaHash($review['key']);
            $newReview = new Review();
            $newReview->rating_partial_id = $ratingPartial->id;
            $newReview->score = $review['rating'];
            $newReview->possible_score = $ratingPartial->possible_score;
            $newReview->note = $review['note'];

            $rating->score += $review['rating'];
            $rating->possible_score += $ratingPartial->possible_score;

            $reviews[] = $newReview;
        }

        $rating->score_as_percent = ($rating->score/$rating->possible_score)*100;

        $rating->save();
        foreach ($reviews as $review) {
            $review->rating_id = $rating->id;
            $review->save();
        }

        echo json_encode(['success' => true]);
    }

    public function show($id)
    {
        return view('ratings.show');
    }

    public function edit($id)
    {
        return view('ratings.create');
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
