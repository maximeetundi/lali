@extends('errors.layout')

@section('title', trans('Page Expired'))
@section('message', trans('Sorry, your session has expired, please refresh and try again'))

@section('link')
    <a href="{{ url('/') }}" class="btn btn-link">{{ trans('Back to homepage') }}</a>
@endsection
