   <!-- ======= About Us Section ======= -->
   <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>A Propos</h2>
      <p title="text_apropos"><?= gen_text($texts, 'text_apropos', 'fr_l') ?></p>
      </div>

      <div class="row gy-4">
        <div class="col-lg-6">
          <h3 title="titre_processus">{{ gen_text($texts, 'titre_processus') }}</h3>
           <div class="position-relative mt-4">
              <img src="{{ $image2 }}" class="img-fluid rounded-4" alt="">
              <a href="{{ $video2 }}" class="glightbox play-btn"></a>
            </div>
        
        </div>
        <div class="col-lg-6">
          <div class="content ps-0 ps-lg-5">
            <?= gen_text($texts, 'description_processus', 'fr_l') ?>

      
          </div>
        </div>
      </div>

    </div>
  </section><!-- End About Us Section -->

  <!-- ======= Clients Section ======= -->
  <section id="clients" class="clients">
    <div class="container" data-aos="zoom-out">

      <div class="clients-slider swiper">
        <div class="swiper-wrapper align-items-center">
          @foreach ($partners as $partner)
          <div class="swiper-slide"><img src="{{ getUrlMedia($partner) }}" class="img-fluid" alt=""></div>
          @endforeach
        </div>
      </div>

    </div>
  </section><!-- End Clients Section -->