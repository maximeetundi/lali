   <!-- ======= Portfolio Section ======= -->
   <section id="portfolio" class="portfolio sections-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>Portfolio</h2>
        {{ gen_text($texts, 'description_portofolio') }}
      </div>

      <div class="portfolio-isotope" data-portfolio-layout="masonry" data-portfolio-sort="original-order" data-aos="fade-up" data-aos-delay="100">


        <div class="row gy-4 portfolio-container">
 
     @foreach ($portofolios as $portofolio)
      <div class="col-xl-4 col-md-6 portfolio-item">
        <div class="portfolio-wrap">
         <center>
          <a href="{{ $portofolio->media->first() <> null ? $portofolio->media->first()->getUrl() : '#' }}" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ $portofolio->media->first() <> null ? $portofolio->media->first()->getUrl() : '' }}" class="img-fluid" alt=""></a>
          <div class="portfolio-info">
            <h4><a href="portfolio-details.html" title="More Details">{{ $portofolio->name }}</a></h4>
            <p>{{ $portofolio->description }}</p>
          </div>
         </center>
        </div>
      </div><!-- End Portfolio Item -->
     @endforeach


    

        </div><!-- End Portfolio Container -->

      </div>

    </div>
  </section><!-- End Portfolio Section -->