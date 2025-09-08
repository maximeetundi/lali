  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2 title="nom_entreprise">{{ gen_text($texts, 'nom_entreprise') }}</h2>
          <p title="description_entete">{{  gen_text($texts, 'description_entete')  }}</p>
          <div class="d-flex justify-content-center justify-content-lg-start">
            <a href="#about" class="btn-get-started">Commencer la Visite</a>
            <a  href="{{ $video1 }}" class="video1 glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Regarder la vidéo</span></a>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img title="image1" src="{{ asset($image1) }}" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>


    <div class="icon-boxes position-relative">
      <div class="container position-relative">
        <div class="row gy-4 mt-5">


          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-whatsapp"></i></div>
              <h4 class="title"><a href="whatsapp://send?text=Salut Pouvez vous m'en dire plus sur l'entreprise ? !&phone=+237678805224" class="stretched-link">Whatsapp</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-facebook"></i></div>
              <h4 class="title"><a href="https://web.facebook.com/profile.php?id=61552399170957" target="_blank" class="stretched-link">Facebook</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-instagram"></i></div>
              <h4 class="title"><a href="https://www.instagram.com/lalichips/" target="_blank" class="stretched-link">Instagram</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-twitter"></i></div>
              <h4 class="title"><a href="https://twitter.com/LaliChips" target="_blank" class="stretched-link">Twitter</a></h4>
            </div>
          </div><!--End Icon Box -->

        </div>
      </div>
    </div>

    </div>
  </section>
  <!-- End Hero Section -->