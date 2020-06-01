@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            <tr>
                <th>Name</th>
                <th>Media Type</th>
                <th>Profile</th>
            </tr>
            @foreach($profiles as $profile)
                <tr>
                    <td>{{ $profile->name }}</td>
                    <td>{{ $profile->media_type }}</td>
                    <td>
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
                    </td>
                    <td>
                        <a href="{{ route('rating-partials.edit', ['rating_partial' => $profile->hashid]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    {{ $profiles->render() }}
@endsection
