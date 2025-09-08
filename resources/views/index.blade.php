
@extends('layout.app')
@section('content')

  @include('hero')

  <main id="main">

    @include('about_partner')

    @include('stat_mission')


    @include('portofolio')

    @include('team_prod')

    @include('faq')

    @include('contact')

  </main><!-- End #main -->
  @endsection