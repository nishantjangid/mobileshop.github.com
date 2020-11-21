@extends('layout')

@section('content')

<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">My Account</li>
        </ol>
    </nav>  
    @if(session('alertSuccess'))
    <div class="alert alert-danger alert-box alert-dismissible fade show mx-5">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong style="font-size: 2rem;">Item Successfully added into Cart</strong>.
    </div>
    @endif 
    <div id="cartWrapper"> 
        <div class="row">
            <div class="col-md-3 col-sm-12">
                @include('account_sidebar')
            </div>
            <div class="col-md-9 col-sm-12 mt-3">
                @foreach($wishlists as $items)
                <?php
                $salePrice = $items->product_price-$items->product_discount;
                $actualPrice = $items->product_price;
                $discount =round(($items->product_discount/$items->product_price)*100);
                $qty = $items->qty;
                // echo $qty;
                $salePrice = ($salePrice * $qty);
                $actualPrice = ($actualPrice * $qty);
                ?>             
                <div class="row cartBxHeight boxShadow">
                    <div class="col-lg-3 col-md-12 col-sm-12">
                        <div class="productImage">
                            <a href="details/{{$items->product_title}}">
                                <img src="{{asset($items->product_img1)}}" alt="productCartImage">
                            </a>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">           
                        <div class="productDetails">
                            <div class="productName">
                                <p>{{$items->product_title}}</p>
                            </div>
                            <div class="productUpdate">
                                <form action="" method="post">
                                <label class="">Qty:&nbsp;</label>
                                @csrf
                                    <select name="product_qty" class="product_qty" data-product_id="{{$items->id}}" disabled>
                                            <option value="1" @if($items->qty==1) selected @endif >1</option>
                                            <option value="2" @if($items->qty==2) selected @endif >2</option>
                                            <option value="3" @if($items->qty==3) selected @endif >3</option>
                                            <option value="4" @if($items->qty==4) selected @endif >4</option>
                                            <option value="5" @if($items->qty==5) selected @endif >5</option>
                                    </select>
                                </form>
                            </div>
                            <div class="productPriceInfo">
                                {{-- <p>Rs. {{  number_format($items->product_price-$items->product_discount, 2, '.', ',') }}  / <br> Rs.<strike> {{ number_format( $items->product_price, 2, '.', ',' ) }}</strike> ( {{  round(($items->product_discount/$items->product_price)*100) }}%) OFF</p> --}}
                                <p class=""> <span class="salePrice">  Rs. {{ number_format($salePrice, 2,'.',',')  }} </span> @if($discount>0)
                                    /<br>Rs.<strike> {{ number_format($actualPrice, 2,'.',',') }}</strike>
                                    ( {{  $discount }}%) OFF
                                    @endif
                                    </p>                            
                            </div>                  
                        </div>           
                        <div class="productAction">
                            <a href="delete-wishlist/{{$items->wishlist_id}}" class="text-danger" id="cartDeleteBtn">Delete <i class="fa fa-trash"></i></a>
                            <a href="/addtocart/{{$items->id}}" class="allBtnStyle wishListBtn">Move to Cart <i class="fa fa-shopping-cart"></i></a>            
                        </div> 
                    </div> 

                </div> 
                @endforeach 
            </div> 
        </div>
    </div>
</div>



@endsection