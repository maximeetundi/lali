    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">
  
          <div class="row gy-4">
  
            <div class="col-lg-4">
              <div class="content px-xl-5">
                <h3 class="text-cebter"><?= gen_text($texts, 'titre_faq', 'fr_l') ?></h3>
                <p>
                  <?= gen_text($texts, 'description_faq') ?>
                </p>
              </div>
            </div>
  
            <div class="col-lg-8">
  
              <div class="accordion accordion-flush" id="faqlist" data-aos="fade-up" data-aos-delay="100">
  
              @foreach ($faqs as $faq)
                <div class="accordion-item">
                  <h3 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq-content-<?= $faq->id ?>">
                    
                     {{ $faq->name }}
                    </button>
                  </h3>
                  <div id="faq-content-<?= $faq->id ?>" class="accordion-collapse collapse" data-bs-parent="#faqlist">
                    <div class="accordion-body">
                      <?=  $faq->fr  ?>
                    </div>
                  </div>
                </div><!-- # Faq item-->
              @endforeach
  
 
  
           
  
  
              </div>
  
            </div>
          </div>
  
        </div>
      </section><!-- End Frequently Asked Questions Section -->