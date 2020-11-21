@extends('layout')

@section('content')

@include('sweet::alert')
<?php

$discount = round(($productInfo->product_discount/$productInfo->product_price)*100);
?>
<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="/shop">Shop</a></li>
            <li class="breadcrumb-item" aria-current="page">{{$productInfo->product_title}}</li>
        </ol>
    </nav>  

<!-- Product Detail Section Start -->
<div class="container" id="productDetails">
    <div class="row">
        <div class="col-md-4 col-lg-2 col-sm-4 col-4">
            <div class="leftSideImageGrid">
                <div class="SampleImage boxShadow lazyOwl" data-index="1">
                    <img src="{{asset($productInfo->product_img1)}}" alt="" >
                </div>
                <div class="SampleImage boxShadow lazyOwl" data-index="2">
                    <img src="{{asset($productInfo->product_img2)}}" alt="">
                </div>
                <div class="SampleImage boxShadow lazyOwl" data-index="3">
                    <img src="{{asset($productInfo->product_img3)}}" alt="" >
                </div>
                <div class="SampleImage boxShadow lazyOwl" data-index="4">
                    <img  src="{{asset($productInfo->product_img4)}}" alt="">
                </div>                                                
            </div>
        </div>
        <div class="col-md-8 col-lg-6 col-sm-8 col-8">
            <div class="bigSampleImage">
                {{-- <div id="productDetailSlider" class="owl-carousel boxShadow owl-theme">
                    <div id="productSlider"  data-index="1" id="currentImg" class="item lazyOwl zoom productDetailImg"><img src="{{asset($productInfo->product_img1)}}" alt=""></div>
                    <div id="productSlider"  data-index="2" class="item lazyOwl productDetailImg zoom"><img src="{{asset($productInfo->product_img2)}}" alt=""></div>
                    <div id="productSlider" data-index="3"  class="item lazyOwl productDetailImg zoom"><img src="{{asset($productInfo->product_img3)}}" alt=""></div>
                    <div id="productSlider" data-index="4"  class="item lazyOwl productDetailImg zoom"><img src="{{asset($productInfo->product_img4)}}" alt=""></div>                    
                </div>                 --}}
                <div class="slider demo" id="productDetailSlider">
                      <div id="productSlider"  data-index="1" class="item  zoom productDetailImg">
                        <img src="{{asset($productInfo->product_img1)}}" alt="">
                      </div>

                      <div id="productSlider"  data-index="2" class="item  zoom productDetailImg">
                        <img src="{{asset($productInfo->product_img2)}}" alt="">
                      </div>

                      <div id="productSlider"  data-index="3" class="item  zoom productDetailImg">
                        <img src="{{asset($productInfo->product_img3)}}" alt="">
                      </div>

                      <div id="productSlider"  data-index="4" class="item  zoom productDetailImg">
                        <img src="{{asset($productInfo->product_img4)}}" alt="">
                      </div>                      
                </div>
                    
            </div>
        </div>
        <div class="col-md-12 col-lg-4 col-12">
            <div class="productDesc">
                <div class="brandName">
                    <span>{{$productInfo->product_title}}</sapn>
                </div>
                <div class="brandDetails">
                    <p>{{$productInfo->product_description}}</p>
                </div>   
              
                <div class="brandPrice">
                    <span>Rs. <span id="salePrice">{{  number_format($productInfo->product_price-$productInfo->product_discount, 2, '.', ',') }}</span>
                     @if($discount>0)  / Rs.<strike id="listPrice"> {{ number_format( $productInfo->product_price, 2, '.', ',' ) }}</strike> ({{ $discount}} %) OFF @endif </span>
                </div>  

                <form action="/add_to_cart" method="post">
                    <div class="quantityBtn ">
                            <span id="qtyAdd">+</span>
                                <input type="text" class="proQtyInput" value="1" name="product_qty" readonly>
                            <span id="qtyMinus">-</span>
                    </div>                 
                    <div class="productQty">     

                            @csrf
                            <input type="hidden" class="" name="product_id" value="{{$productInfo->id}}">
                            <button type="submit" class="allBtnStyle addtocart">ADD TO CART <i class="fa fa-shopping-cart"></i></button>
                            <button type="button" class="allBtnStyle wishListBtn">SAVE WISHLIST <i class="fa fa-heart"></i></a>
                    </div>                             
                </form>              
            </div>
        </div>  
        
                <!-- Product You May Like Start -->
                <div class="productMayLike mt-5">
                    <div class="contentHeading">
                        <h3>Product You May Like</h3>
                    </div>
                    <div class="LatestProductgallery">
                        
                        <div class="galleryImage Newest" >
                            <a href="">
                                <img src="{{asset('Products/8.png')}}" alt="ProductImage1">
                            </a>
                            <div class="ProductBtn">
                                <a href="details" class="btn btn-default allBtnStyle viewBtn"  >View Details</a>
                                                
                            </div>    
                            <div class="productDetails">
                                <h4></h4>
                                <span class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </span>
                                <p>Rs 24999</p>
                            </div>            
                        </div>
                     
                        <div class="galleryImage Newest" >
                            <a href="">
                                <img src="{{asset('Products/8.png')}}" alt="ProductImage1">
                            </a>
                            <div class="ProductBtn">
                                <a href="details" class="btn btn-default allBtnStyle viewBtn"  >View Details</a>
                                                
                            </div>    
                            <div class="productDetails">
                                <h4>Samsung Galaxy A51</h4>
                                <span class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </span>
                                <p>Rs 24999</p>
                            </div>            
                        </div>
                        <div class="galleryImage Newest" >
                            <a href="">
                                <img src="{{asset('Products/8.png')}}" alt="ProductImage1">
                            </a>
                            <div class="ProductBtn">
                                <a href="details" class="btn btn-default allBtnStyle viewBtn"  >View Details</a>
                                                
                            </div>    
                            <div class="productDetails">
                                <h4>Samsung Galaxy A51</h4>
                                <span class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                </span>
                                <p>Rs 24999</p>
                            </div>            
                        </div>                                                
                    </div>                
                </div>
                <!-- Product You May Like End -->        

    </div>
</div>

<!-- Product Detail Section End -->

</div>


@endsection