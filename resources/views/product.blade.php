
@extends('layout.app')
@section('content')
  <main id="main">
       <!-- ======= About Us Section ======= -->
   <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="section-header">
        <h2>{{ $product->name }}</h2>
      <p title="text_apropos">Prix: <b>{{ $product->skus->first()->price }} FCFA</b> / Carton</p>

      <center> 
        <a href="whatsapp://send?text=Bonsoir j'ai bedoin de ce produit <?= route('product.view', $product->slug) ?>!&phone=+237678805224" class="btn btn-warning btn-lg stretched-link">Commander</a>
</center>
      </div>
  
      <div class="row ">
    
        <div class="col-lg-6">
          
            <div class="content ps-0 ps-lg-5">
                <center><h3><u>Description</u></h3></center>
               <?= $product->description ?>
            </div>
          </div>

        <div class="col-lg-6">

            <div class="container py-5">
      <center><h3><u>Caractéristiques</u></h3></center>
              <div style="display: flex; overflow:auto;">
                @foreach ($product->skus as $sku)
                <div class="row mb-4">
                  <h4>{{ str_replace('-', ' ', $sku->code) }}</h4>
                  @foreach ($sku->attributeOptions as $attributeOption)
                 
                    <p>{{ $attributeOption->attribute->name }} : <b> {{ $attributeOption->value }}</b></p>
              
                  @endforeach
                </div>
              @endforeach
              </div>
              </div>
        
       <center>
        <div class="position-relative mt-4">
           
            <a href="{{ $product->media->first() <> null ? $product->media->first()->getUrl() : '' }}" data-gallery="portfolio-gallery-app" class="glightbox"> <img src="{{ $product->media->first() <> null ? $product->media->first()->getUrl() : '' }}" class="img-fluid rounded-4 " alt="#"></a>


           <div style="display: flex; overflow:auto">
            @foreach ($product->media as $media)
            <div class="col-xl-4 col-md-6 portfolio-item">
                <div class="portfolio-wrap">
                <a href="{{ $product->media->first() <> null ? $product->media->first()->getUrl() : '' }}" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ $media <> null ? $media->getUrl() : '' }}" class="img-fluid" alt=""></a>
                </div>
            </div><!-- End Portfolio Item -->
           @endforeach

           @foreach ($product->skus as $skus)
           @foreach ($skus->media as $media)
            <div class="col-xl-4 col-md-6 portfolio-item">
                <div class="portfolio-wrap">
                <a href="{{ $product->media->first() <> null ? $product->media->first()->getUrl() : '' }}" data-gallery="portfolio-gallery-app" class="glightbox"><img src="{{ $media <> null ? $media->getUrl() : '' }}" class="img-fluid" alt=""></a>
                </div>
            </div><!-- End Portfolio Item -->
            @endforeach
           @endforeach


           </div>

        </div>
       </center>
        
        </div>
       
      </div>

    </div>
  </section><!-- End About Us Section -->


   

  </main><!-- End #main -->
  @endsection