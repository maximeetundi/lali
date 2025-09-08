
@extends('layout.yummy')
@section('content')

  @include('hero')

  <main id="main">

    @include('about_partner')

    @include('stat_mission')


    @include('portofolio')

    {{-- Yummy extra sections (e.g., gallery) --}}
    @include('yummy.extra_sections')

    @include('team_prod')

    @include('faq')

    @include('contact')

  </main><!-- End #main -->
  @endsection