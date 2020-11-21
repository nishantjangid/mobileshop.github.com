@extends('layout')

@section('content')
<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Shop</li>
        </ol>
    </nav>  

    <div class="row"> <!-- row start -->


        <div class="col-md-12 col-lg-10 offset-lg-1 col-12">
            <!-- PRODUCTS LIST START -->
            @if($products->isEmpty())
            <div class="SearchResultBox">
                <p>Result not found for {{ $getUrlParameter = \Request::fullUrl() }}  </p>
            </div>
            @endif
            <div class="productList">
                <div class="text-left my-4 bg-white">
                    <h2 class=" font-weight-bold ">Result found for {{ $getUrlParameter = \Request::fullUrl() }} </h2>
                </div>
                <div class="LatestProductgallery">
                @foreach($products as $items)

                    
                    <div class="galleryImage @if($items->category_id == 1) Samsung @elseif($items->category_id == 2) Oppo @elseif($items->category_id == 3) Vivo @elseif($items->category_id == 4) Iphone @elseif($items->category_id == 5) Xiaomi @endif" >
                        <div class="discountBatch">
                            <p>( {{  round(($items->product_discount/$items->product_price)*100) }}%) OFF</p>
                        </div>
                        <a href="details/{{$items->product_title}}">
                            <img src="{{asset($items->product_img1)}}" alt="ProductImage1">
                        </a>
                        <div class="ProductBtn">
                            <a href="details/{{$items->product_title}}" class="btn btn-default allBtnStyle viewBtn" >View Details</a>
                                            
                        </div>    
                        <div class="productDetails">
                            <h4>{{$items->product_title}}</h4>
                            <span class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                            <p>Rs. {{  number_format($items->product_price-$items->product_discount, 2, '.', ',') }}  / <br> Rs.<strike> {{ number_format( $items->product_price, 2, '.', ',' ) }}</strike></p>
                        </div>            
                    </div>
                @endforeach                                                                                                                   
                </div>  

            </div>
            <div class="prodPagination">
                {{$products->links()}}
            </div>

            <!-- PRODUCTS LIST END -->
        </div>

    </div><!-- row end -->
</div>
@endsection