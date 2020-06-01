@extends('layouts.app')

@section('content')
    <profile-form
        :profile="{{ $profile }}"
        :all_partials="{{ $ratingPartials }}"
    ></profile-form>
@endsection
