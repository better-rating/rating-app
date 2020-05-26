@extends('layouts.app')

@section('content')
    <div class="container">
        <table>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Possible Score</th>
                <th>Labels</th>
                <th>Edit</th>
            </tr>
            @foreach($ratingPartials as $ratingPartial)
                <tr>
                    <td>{{ $ratingPartial->name }}</td>
                    <td>{{ $ratingPartial->description }}</td>
                    <td>{{ $ratingPartial->possible_score }}</td>
                    <td>{{ $ratingPartial->simple_labels }}</td>
                    <td><a href="{{ route('rating-partials.edit', ['rating_partial' => $ratingPartial->hashid]) }}">Edit</a></td>
                </tr>
            @endforeach
        </table>
    </div>

    {{ $ratingPartials->render() }}
@endsection
