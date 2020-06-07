@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            <tr>
                <th>Name</th>
                <th>Release Date</th>
                <th>Rating</th>
            </tr>
            @foreach($movies as $movie)
                <tr>
                    <td>{{ $movie->name }}</td>
                    <td>{{ date('M d, Y', strtotime($movie->release_date)) }}</td>
                    <td>
                        @if(!$movie->rating)
                        <a href="{{ route('ratings.create', ['media_type' => 'movie', 'media_id' => $movie->slug]) }}">Rate</a>
                        @else
                            <star-rating
                                :rating="{{ $movie->rating->score_as_percent/10 }}"
                                :max-rating="10"
                                :read-only="true"
                                :show-rating="false"
                                :rounded-corners="true"
                            ></star-rating>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {{ $movies->render() }}
@endsection
