@extends('errors.layout')

@section('title', trans('Service unvailable'))
@section('message', trans('Certainly a maintenance, please try again in a few minutes'))

@section('link')
    <a href="{{ Request::url() }}" class="btn btn-link">{{ trans('Refresh') }}</a>
@endsection
