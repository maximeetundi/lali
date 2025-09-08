@extends('errors.layout')

@section('title', trans('Unauthorized'))
@section('message', trans('The client request has not been completed because it lacks valid authentication credentials for the requested resource.'))

@section('link')
    <a href="{{ url('/') }}" class="btn btn-link">{{ trans('Back to homepage') }}</a>
@endsection
