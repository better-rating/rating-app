@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="grid grid-cols-4 auto-rows-min">
            <div class="font-bold col-span-1 h-8 text-white bg-gray-700 rounded-tl">Name</div>
            <div class="font-bold col-span-1 h-8 text-white bg-gray-700">Release Date</div>
            <div class="font-bold col-span-1 h-8 text-white bg-gray-700">Rating</div>
            <div class="font-bold col-span-1 h-8 text-white bg-gray-700 rounded-tr">Rated On</div>
            @foreach($movies as $movie)
                <div class="col-span-1 py-2 h-16 pl-2 border-b border-l text-1xl font-bold">{{ $movie->name }}</div>
                <div class="col-span-1 py-2 h-16 border-b">{{ date('M d, Y', strtotime($movie->release_date)) }}</div>
                <div class="col-span-1 py-2 h-16 border-b">
                    @if(!$movie->rating)
                        <a class="btn btn-yellow" href="{{ route('ratings.create', ['media_type' => 'movie', 'media_id' => $movie->slug]) }}">Rate</a>
                    @else
                        {{ $movie->rating->score_as_percent/10 }}/10
                    @endif
                </div>
                <div class="col-span-1 py-2 h-16 border-b border-r">
                    @if($movie->rating)
                        {{ $movie->rating->created_at->format('m/d/Y') }}
                    @endif
                </div>
            @endforeach
        </div>
    </div>

    {{ $movies->render() }}
@endsection
