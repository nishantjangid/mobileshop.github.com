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
        <div class="col-md-12 col-lg-4 col-sm-12"> <!-- col-md-12 col-lg-4 col-sm-12 Start-->
            <!-- SIDEBAR SECTION START-->
            <aside id="sidebar" class="allSectionMargin">
                <!-- rangeFilter start -->
                <div class="sideBarBox boxShadow">
                    <div class="rangeFilter">
                        <form method="get" action="{{URL::current()}}">
                            <div data-role="rangeslider" class="rangeslider">
                                <label for="price-min">Price:</label>
                                <input type="range" id="priceRange"  name="pricerange" id="price-min" value="200" min="0" max="30000">
                            </div>
                            <p>Range: <span class="range">0</span></p>                        
                            <input type="submit" class="btn btn-primary allBtnStyle" data-inline="true" value="Filter">
                        </form>                    
                    </div>                    
                </div>
                <!-- rangeFilter end -->

                <!-- ProductBrand start -->
                <div class="sideBarBox boxShadow">
                    <div class="productBrand">
                        <h3>Brands</h3>
                        <ul class="BrandList">
                            <li><input type="radio" checked name="brand" class="filterShopBtn" data-filter="All">All</li>                            
                            <li><input type="radio" name="brand" class="filterShopBtn" data-filter="Samsung">Samsung</li>                            
                            <li><input type="radio" name="brand" class="filterShopBtn" data-filter="Xiaomi">Xiaomi</li>
                            <li><input type="radio" name="brand" class="filterShopBtn" data-filter="Oppo">Oppo</li>
                            <li><input type="radio" name="brand" class="filterShopBtn" data-filter="Vivo">Vivo</li>
                            <li><input type="radio" name="brand" class="filterShopBtn" data-filter="Iphone">I Phone</li>
                        </ul>
                    </div>
                </div>
                <!-- ProductBrand End-->

                <!-- Rating Filter start-->
                <div class="sideBarBox boxShadow">
                    <div class="ratingFilter">
                        <h3>Rating Filter</h3>
                        <span class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                    </div>
                </div>
                <!-- Rating Filter end-->


            </aside>    
            <!-- SIDEBAR SECTION END-->
        </div><!-- col-md-12 col-lg-4 col-sm-12 Start-->

        <div class="col-md-12 col-lg-8 col-12">
            <!-- PRODUCTS LIST START -->
            <div class="productList">
                <div class="LatestProductgallery allSectionMargin">
                @foreach($products as $items)

                    
                    <div class="galleryImage @if($items->category_id == 1) Samsung @elseif($items->category_id == 2) Oppo @elseif($items->category_id == 3) Vivo @elseif($items->category_id == 4) Iphone @elseif($items->category_id == 5) Xiaomi @endif" >
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
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            </span>
                            <p class="text-center">Rs. {{  number_format($items->product_price-$items->product_discount, 2, '.', ',') }}
                            @if($discount>0)
                            / Rs.<strike> {{ number_format( $items->product_price, 2, '.', ',' ) }}</strike>
                            @endif
                            </p>
                        </div>            
                    </div>
                @endforeach                                                                                                                   
                </div>  

            </div>
            <div class="prodPagination">
                {{$products->links()}}
            </div>
            <!-- Modal -->
            <!-- <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="modal-body">
                        <p>Some text in the modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    </div>

                </div>
            </div>   -->

            <!-- PRODUCTS LIST END -->
        </div>

    </div><!-- row end -->
</div>
@endsection