@extends('layouts.app')

@section('content')
    <profile-form
        :all_partials="{{ $ratingPartials }}"
    ></profile-form>
@endsection
