    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
        <div class="container" data-aos="fade-up">
  
          <div class="row gy-4 align-items-center">
  
            <div class="col-lg-6">
              <img src="assets/img/stats-img.svg" alt="" class="img-fluid">
            </div>
  
            <div class="col-lg-6">
  
              <div class="stats-item d-flex align-items-center">
                <b>+</b> <span data-purecounter-start="0" data-purecounter-end="150" data-purecounter-duration="1" class="purecounter"></span>
                <p><strong>Clients Satisfaits</strong> </p>
              </div><!-- End Stats Item -->
  
              <div class="stats-item d-flex align-items-center">
                <b>+</b><span data-purecounter-start="0" data-purecounter-end="10000" data-purecounter-duration="1" class="purecounter"></span>
                <p><strong>Cartons Produits</strong> </p>
              </div><!-- End Stats Item -->
  
              <div class="stats-item d-flex align-items-center">
                <span data-purecounter-start="0" data-purecounter-end="3" data-purecounter-duration="1" class="purecounter"></span>
                <p><strong> Poduit</strong> </p>
              </div><!-- End Stats Item -->
  
            </div>
  
          </div>
  
        </div>
      </section><!-- End Stats Counter Section -->
  
  
  
      <!-- ======= Our Services Section ======= -->
      <section id="services" class="services sections-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-header">
            <h2>Missions</h2>
            {{ gen_text($texts, 'description_mission') }}
          </div>
  
          <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">
  
           @foreach ($missions as $mission)
            <div class="col-lg-4 col-md-6">
              <div class="service-item  position-relative">
                <div class="icon">
                  <i class="bi bi-activity"></i>
                </div>
              <p><?= $mission->fr ?></p>
              </div>
            </div><!-- End Service Item -->
           @endforeach
  
   
  
        
            <div class="col-lg-4 col-md-6">
           
  
          </div>
  
        </div>
      </section><!-- End Our Services Section -->
  