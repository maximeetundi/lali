  
      <!-- ======= Pricing Section ======= -->
      <section id="pricing" class="pricing sections-bg">
        <div class="container" data-aos="fade-up">
  
          <div class="section-header">
            <h2>{{ gen_text($texts, 'titre_prix') }}</h2>
            <p><?= gen_text($texts, 'description_prix', 'fr_l') ?></p>
          </div>
  
          <div class="row g-4 py-lg-5" data-aos="zoom-out" data-aos-delay="100">
 
            @foreach ($products as $product)
                
            <div class="col-lg-4">
              <div class="pricing-item">
                <h3><b>{{ $product->name }}</b></h3>
                <div class="icon">
                  <img class="img-fluid rounded" src="{{ getUrlMedia($product) }}" alt="">
                </div>
                <h4><sup>fcfa</sup>
                  {{ $product->skus->first() <> null ? $product->skus->first()->price : 'NAN'; }}
                  <span> / carton</span></h4>
                <ul>
                  <?= $product->description ?>
                </ul>
                <div class="text-center"><a href="{{ route('product.view', $product->slug) }}" class="buy-btn">Voir</a></div>
              </div>
            </div><!-- End Pricing Item -->

            @endforeach


            
            
  
  
          </div>
  
        </div>
      </section><!-- End Pricing Section -->