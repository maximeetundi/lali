@extends('errors.layout')

@section('title', trans('Forbidden'))
@section('message', trans('The access is permanently forbidden and tied to the application logic, such as insufficient rights to a resource'))

@section('link')
    <a href="{{ url('/') }}" class="btn btn-link">{{ trans('Back to homepage') }}</a>
@endsection
