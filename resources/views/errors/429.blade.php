@extends('errors.layout')

@section('title', trans('Too Many Requests'))
@section('message', trans('The client application has surpassed its number of requests they can send in a given period of time'))

@section('link')
    <a href="{{ url('/') }}" class="btn btn-link">{{ trans('Back to homepage') }}</a>
@endsection
