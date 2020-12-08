@extends('layouts.app')
@section('content')
    <default-form
        media_model="{{ $modelClass }}"
        :media_manifest="{{ json_encode($mediaManifest) }}"
        :fields="{{ json_encode($columns ?? config($config_name.'.columns')) }}"
    ></default-form>
@endsection
