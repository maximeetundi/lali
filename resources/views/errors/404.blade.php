@extends('errors.layout')

@section('title', trans('Not found'))
@section('message', trans('The server did not find the requested address'))

@section('link')
    <a href="{{ url('/') }}" class="btn btn-link">{{ trans('Back to homepage') }}</a>
@endsection
