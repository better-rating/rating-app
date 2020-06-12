@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-5 row-gap-4">
            <div class="font-bold col-span-1">Name</div>
            <div class="font-bold col-span-1">Release Date</div>
            <div class="font-bold col-span-3">Rating</div>
            @foreach($movies as $movie)
                <div class="col-span-1 text-2xl font-bold">{{ $movie->name }}</div>
                <div class="col-span-1">{{ date('M d, Y', strtotime($movie->release_date)) }}</div>
                <div class="col-span-3">
                    @if(!$movie->rating)
                        <a class="btn btn-yellow" href="{{ route('ratings.create', ['media_type' => 'movie', 'media_id' => $movie->slug]) }}">Rate</a>
                    @else
                        <star-rating
                            :rating="{{ $movie->rating->score_as_percent/10 }}"
                            :max-rating="10"
                            :read-only="true"
                            :show-rating="false"
                            :rounded-corners="true"
                        ></star-rating>
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{ $movies->render() }}
@endsection
