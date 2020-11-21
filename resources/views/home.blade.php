@extends('layout')

@section('content')
@include('sweet::alert')
<div id="bannerImage" class="allSectionSpaces">
    <img src="{{asset('images/Banner1.png')}}" alt="">
</div>
<div class="container">
    <div class="row allSectionSpaces">
        <!-- Static Single Item Start -->
        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
            <div class="single-static bg-white">
                <img src="{{asset('images/static-icons-1.png')}}" alt="" class="img-responsive" />
                <div class="single-static-meta">
                    <h4>Free Shipping</h4>
                    <p>On all orders over $75.00</p>
                </div>
            </div>
        </div>
        <!-- Static Single Item End --> 
        <!-- Static Single Item Start -->
        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
            <div class="single-static bg-white">
                <img src="{{asset('images/static-icons-2.png')}}" alt="" class="img-responsive" />
                <div class="single-static-meta">
                    <h4>Free Returns</h4>
                    <p>Returns are free within 9 days</p>
                </div>
            </div>
        </div>
        <!-- Static Single Item End --> 
        <!-- Static Single Item Start -->
        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
            <div class="single-static bg-white">
                <img src="{{asset('images/static-icons-3.png')}}" alt="" class="img-responsive" />
                <div class="single-static-meta">
                    <h4>Support 24/7</h4>
                    <p>Contact us 24 hours a day</p>
                </div>
            </div>
        </div>
        <!-- Static Single Item End --> 
        <!-- Static Single Item Start -->
        <div class="col-lg-3 col-xs-12 col-md-6 col-sm-6">
            <div class="single-static bg-white">
                <img src="{{asset('images/static-icons-4.png')}}" alt="" class="img-responsive" />
                <div class="single-static-meta">
                    <h4>100% Payment Secure</h4>
                    <p>Your payment are safe with us.</p>
                </div>
            </div>
        </div>
        <!-- Static Single Item End -->                                
    </div>

        <!-- Banner Area Start -->
        <div class="banner-area">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="banner-wrapper">
                        <a href="shop-4-column.html"><img src="{{asset('images/show-img-1.jpg')}}" alt="" /></a>
                    </div>
                    <div class="banner-wrapper">
                        <a href="shop-4-column.html"><img src="{{asset('images/show-img-2.jpg')}}" alt="" /></a>
                    </div>
                    <div class="banner-wrapper">
                        <a href="shop-4-column.html"><img src="{{asset('images/show-img-3.jpg')}}" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area End -->    

        <!-- ourLatestProducts Start-->
    <div class="ourLatestProducts">
        <div class="allSectionSpaces">
            <div class="contentHeading">
                <h3>Our Latest Products</h3>
            </div>  
        </div>
        
        <div class="proFilterButtons my-5">
            <button type="button" class="btn btn-default allBtnStyle filterBtn btnActive" data-filter="All">All</button>            
            <button type="button" class="btn btn-default allBtnStyle filterBtn" data-filter="Newest">Newest</button>
            <button type="button" class="btn btn-default allBtnStyle filterBtn" data-filter="Oldest">Oldest</button>
        </div>

        <div class="LatestProductgallery">
        @foreach($products as $items)
            <div class="galleryImage {{$items->product_label}}" >

                <?php
                $discount =round(($items->product_discount/$items->product_price)*100);
                ?>
                @if($discount>0)
                <div class="discountBatch">
                    <p>({{$discount}} %) OFF</p>
                </div>
                @endif
                <a href="details/{{$items->product_title}}">
                    <img src="{{asset($items->product_img1)}}" alt="ProductImage1">
                </a>
                <div class="ProductBtn">
                    <a href="details/{{$items->product_title}}" class="btn btn-default allBtnStyle viewBtn" >View Details</a>
                                      
                </div>    
                <div class="productDetails">
                    <h4>{{$items->product_title}}</h4>
                    <span class="rating">
                    @for($i=0; $i<5; $i++)
                        <i class="fa fa-star"></i>
                    @endfor
                    </span>
                    <p class="text-center">Rs. {{  number_format($items->product_price-$items->product_discount, 2, '.', ',') }}
                    @if($discount>0)
                    / Rs.<strike> {{ number_format( $items->product_price, 2, '.', ',' ) }}</strike>
                    @endif
                    </p>
                </div>            
            </div>
        @endforeach  
        
            <div class="moreProduct">
                <a href="/shop" class=" viewMoreBtn allBtnStyle">View More</a>
            </div>                                                                                            
        </div>



    </div>
    <!-- ourLatestProducts End-->

    <!-- OurOfferCarousel Start -->
    <div class="col-md-12 col-lg-12 col-12">
        <div class="ourOfferSection">
            <div class="allSectionSpaces">
                    <div class="contentHeading">
                        <h3>Our Latest Offers</h3>
                    </div>  
                <div id="owl-demo" class="OfferImageMar">
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                   <div class="item"><a href=""><img src="{{asset('images/Offer-Image-1.jpg')}}" alt=""></a></div>
                    
                </div>            
            </div>        
        </div> 
    </div>    


</div>

@endsection