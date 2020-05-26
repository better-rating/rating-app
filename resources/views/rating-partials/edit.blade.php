@extends('layouts.app')

@section('content')
    <rating-partial-form
        :ratingpartial="{{$ratingPartial}}"
    ></rating-partial-form>
@endsection
