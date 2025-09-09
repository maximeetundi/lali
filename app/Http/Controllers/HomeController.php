<?php

namespace App\Http\Controllers;

use App\Traits\HomeTrait;
use Domain\Shop\Product\Models\Product;
use Domain\Site\Asset\Models\Asset;
use Domain\Site\MissionFaq\Models\MissionFaq;
use Domain\Site\Partner\Models\Partner;
use Domain\Site\Portofolio\Models\Portofolio;
use Domain\Site\Text\Models\Text;

class HomeController extends Controller
{
    use HomeTrait;

    public function index()
    {
      $asset = Asset::with('media')->get();

      $image1   = $this->getUrlMedia('image1');
      $image2   = $this->getUrlMedia('image2');
      $video1   = $this->getUrlLink('video1');
      $video2   = $this->getUrlLink('video2');
      $missions = MissionFaq::where('status' ,'mission')->get();
      $faqs     = MissionFaq::where('status' ,'faq')->get();
      $partners  = Partner::with('media')->get();
      $portofolios  = Portofolio::with('media')->get();
      $texts  = Text::get();

      $products = Product::with('skus', 'media')->get();
   
        return view('yummy.index', compact(
            'image1', 'image2', 'video1', 'video2',
             'missions', 'faqs', 'partners',
              'portofolios', 'texts', 'products'));
    }

    public function show(Product $product)
    {
     $product->load('skus');

      return view('product' ,compact('product'));
    }


}
