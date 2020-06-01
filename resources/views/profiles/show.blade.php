@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $profile->name }}</h2>
        <a href="{{ route('profiles.edit', ['profile' => $profile->hashid]) }}">Edit</a>
        <div>
            <strong>Media Type</strong> - {{ $profile->media_type }}
        </div>
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Possible Score</th>
            </tr>
            @foreach($profile->rating_partials as $ratingPartial)
                <tr>
                    <td>{{ $ratingPartial->name }}</td>
                    <td>{{ $ratingPartial->description }}</td>
                    <td>{{ $ratingPartial->possible_score }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
