@extends('errors.layout')

@section('title', trans('Server Error'))
@section('message', trans('The server encountered an unexpected condition that prevented it from fulfilling the request'))

@section('link')
    <a href="{{ url('/') }}" class="btn btn-link">{{ trans('Back to homepage') }}</a>
@endsection
