@extends('layout.yummy')

@section('content')
  <!-- Hero Section -->
  <section id="hero" class="hero section light-background">
    <div class="container">
      <div class="row gy-4 justify-content-center justify-content-lg-between">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">{{ gen_text($texts ?? collect(), 'nom_entreprise') }}</h1>
          <p data-aos="fade-up" data-aos-delay="100">{{ gen_text($texts ?? collect(), 'description_entete') }}</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#book-a-table" class="btn-get-started">Réserver</a>
            <a href="{{ $video1 ?? '#' }}" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Voir la vidéo</span></a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
          <img src="{{ isset($image1) ? asset($image1) : asset('assets/yummy/img/hero-img.png') }}" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>
  </section>

  <!-- Why Us Section -->
  <section id="why-us" class="why-us section light-background">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="why-box">
            <h3>Pourquoi nous choisir</h3>
            <p>{{ gen_text($texts ?? collect(), 'text_apropos', 'fr_l') }}</p>
            <div class="text-center">
              <a href="#about" class="more-btn"><span>En savoir plus</span> <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-8 d-flex align-items-stretch">
          <div class="row gy-4" data-aos="fade-up" data-aos-delay="200">
            <div class="col-xl-4">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-clipboard-data"></i>
                <h4>{{ gen_text($texts ?? collect(), 'why_quality_title') ?: 'Qualité' }}</h4>
                <p>{{ gen_text($texts ?? collect(), 'why_quality_desc') ?: 'Des produits contrôlés et approuvés.' }}</p>
              </div>
            </div>
            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-gem"></i>
                <h4>{{ gen_text($texts ?? collect(), 'why_innovation_title') ?: 'Innovation' }}</h4>
                <p>{{ gen_text($texts ?? collect(), 'why_innovation_desc') ?: 'Des saveurs originales et modernes.' }}</p>
              </div>
            </div>
            <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
              <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-inboxes"></i>
                <h4>{{ gen_text($texts ?? collect(), 'why_availability_title') ?: 'Disponibilité' }}</h4>
                <p>{{ gen_text($texts ?? collect(), 'why_availability_desc') ?: 'En stock et livrés rapidement.' }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section id="stats" class="stats section dark-background">
    <img src="{{ isset($image2) ? asset($image2) : asset('assets/yummy/img/stats-bg.jpg') }}" alt="" data-aos="fade-in">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
            <p>Clients</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
            <p>Projets</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
            <p>Heures de support</p>
          </div>
        </div>
        <div class="col-lg-3 col-md-6">
          <div class="stats-item text-center w-100 h-100">
            <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
            <p>Collaborateurs</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section (dynamic) -->
  <section id="gallery" class="gallery section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Galerie</h2>
      <p><span>Découvrez</span> <span class="description-title">Nos Réalisations</span></p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      @php
        $items = collect($portofolios ?? [])->flatMap(function($p){ return $p->media ?? []; });
        if (($items->count() ?? 0) === 0) {
          $items = collect($partners ?? [])->flatMap(function($p){ return $p->media ?? []; });
        }
      @endphp

      @if(($items->count() ?? 0) > 0)
        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {"delay": 3000},
              "slidesPerView": "auto",
              "pagination": {"el": ".swiper-pagination", "type": "bullets", "clickable": true},
              "breakpoints": {"320": {"slidesPerView": 1, "spaceBetween": 0}, "640": {"slidesPerView": 2, "spaceBetween": 0}, "992": {"slidesPerView": 3, "spaceBetween": 0}, "1200": {"slidesPerView": 4, "spaceBetween": 0}}
            }
          </script>
          <div class="swiper-wrapper align-items-center">
            @foreach($items as $media)
              @php $url = method_exists($media, 'getUrl') ? $media->getUrl() : (string) $media; @endphp
              <div class="swiper-slide">
                <a class="glightbox" data-gallery="images-gallery" href="{{ $url }}">
                  <img src="{{ $url }}" class="img-fluid" alt="">
                </a>
              </div>
            @endforeach
          </div>
          <div class="swiper-pagination"></div>
        </div>
      @else
        <div class="alert alert-info">Aucune image disponible pour la galerie pour le moment.</div>
      @endif
    </div>
  </section>
@endsection
