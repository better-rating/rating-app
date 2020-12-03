@extends('layouts.app')
@section('content')
    <default-form
        media_type="{{ $type ?? config($config_name.'.name') }}"
        :fields="{{ json_encode($columns ?? config($config_name.'.columns')) }}"
    ></default-form>
@endsection
