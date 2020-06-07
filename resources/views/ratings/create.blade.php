@extends('layouts.app')

@section('content')
    <rating-form
        media_type="{{ $media_type }}"
        :media="{{ $media }}"
    ></rating-form>
@endsection
