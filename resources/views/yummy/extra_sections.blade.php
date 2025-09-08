{{-- Yummy extra sections integrated while keeping current data flow --}}

{{-- Gallery Section (uses Portofolio media; falls back to Partners media) --}}
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
