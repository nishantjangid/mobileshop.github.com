@extends('layout')

@section('content')
@include('sweet::alert')

<?php

$unitTotalPrice = 0;
$totalDiscount = 0;
$totalPrice = 0;
?>

<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Cart</li>
            </ol>
    </nav>
</div>
@if(session('alertSuccess'))
<div class="alert alert-danger alert-box alert-dismissible fade show mx-5">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong style="font-size: 2rem;">Item Successfully added into Wishlist visit <a href="/wishlist"><b>Wishlist</b></a></strong>.
</div>
@endif     
<!-- CartItemsArea Start-->
<div id="cartWrapper">    
    <!-- <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="">
                <div class="row productCartBorder">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 sideSpaceNon">
                        <div class="productImage">
                            <a href="">
                                <img src="{{asset('Products/1.png')}}" alt="productCartImage">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                        <div class="cartProductDetails">
                            <div class="productDetail">
                                <p>Samsung(Galaxy S10)</p>
                            </div>
                            <div class="productUpdate">
                                <label class="">Qty:&nbsp;</label>
                                <select name="product_qty" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="productPriceInfo">
                                <p>price:30000</p>
                                <p>OFF: <strike>20000</strike>(10%) </p>
                            </div>                                                                                                               
                        </div> 
                        <div class="productAction">
                                <a href="delete" class="allBtnStyle ">Delete<i class="fa fa-trash"></i></a>
                                <a href="delete" class="allBtnStyle ">Move to wishlist <i class="fa fa-heart"></i></a>
                        </div>                                               
                    </div>                
                </div>
                <div class="row productCartBorder">
                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 sideSpaceNon">
                        <div class="productImage">
                            <a href="">
                                <img src="{{asset('Products/1.png')}}" alt="productCartImage">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">
                        <div class="cartProductDetails">
                            <div class="productDetail">
                                <p>Samsung(Galaxy S10)</p>
                            </div>
                            <div class="productUpdate">
                                <label class="">Qty:&nbsp;</label>
                                <select name="product_qty" id="">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="productPriceInfo">
                                <p>price:30000</p>
                                <p>OFF: <strike>20000</strike>(10%) </p>
                            </div>                                                                                 
                        </div>
                        <div class="productAction">
                            <a href="delete" class="allBtnStyle ">Delete<i class="fa fa-trash"></i></a>
                            <a href="delete" class="allBtnStyle ">Move to wishlist <i class="fa fa-heart"></i></a>
                        </div> 
                    </div>                
                </div>                                
            </div>            
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12 col-12">
            order summary
        </div>        
    </div> -->
    <div class="row">
        <div class="col-lg-9 col-md-12 col-sm-12 ">
            @if($CartItemCount==0)
            <div class="cartStatus">
                <h1>Your Cart is empty</h1>
                <p>Please Fill with exciting items</p>
            </div>
            @endif

            @foreach($cartDetail as $items)

            <?php
            $salePrice = $items->product_price-$items->product_discount;
            $actualPrice = $items->product_price;
            $discount =round(($items->product_discount/$items->product_price)*100);
            $qty = $items->qty;
            // echo $qty;
            $salePrice = ($salePrice * $qty);
            $actualPrice = ($actualPrice * $qty);
            $unitTotalPrice += $items->product_price*$qty;
            $totalDiscount += $items->product_discount;
            $totalPrice = $unitTotalPrice-$totalDiscount;
            ?>
                
            <div class="row cartBxHeight boxShadow">
                <div class="col-lg-3 col-md-12 col-sm-12">
                    <div class="productImage">
                        <a href="details/{{$items->product_title}}">
                            <img src="{{asset($items->product_img1)}}" alt="productCartImage">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-12 col-sm-12">
                    <div class="productDetails">
                        <div class="productName">
                            <p>{{$items->product_title}}</p>
                        </div>
                        <div class="productUpdate">
                            <form action="" method="post">
                            <label class="">Qty:&nbsp;</label>
                            @csrf
                                <select name="product_qty" class="product_qty" data-product_id="{{$items->id}}">
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
                        <a href="delete/{{$items->cart_id}}" class="text-danger" id="cartDeleteBtn">Delete <i class="fa fa-trash"></i></a>
                        <a href="/wishlist/{{$items->id}}" class="allBtnStyle wishListBtn">Move to wishlist <i class="fa fa-heart"></i></a>            
                    </div>                         
                </div>   

            </div>
            @endforeach
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
        @if($totalPrice != 0)
            <div class="orderDetails boxShadow">
                <div class="priceDetail">
                    <h4>Order Details</h4>
                    <div class="priceSummery">
                        <span class="label"> Cart Total </span>
                    <span>Rs.{{$unitTotalPrice}}</span>
                    </div>
                    <div class="priceSummery">
                        <span class="label"> Discount </span>
                    <span>- Rs.{{$totalDiscount}}</span>
                    </div>
                    <div class="priceSummery">
                        <span class="label">Coupon Saving</span>
                        <span>Rs 0</span>
                    </div>
                    <div class="priceSummery">
                        <span class="label">Applicable GST</span>
                        <span>Rs. 0</span>
                    </div>     
                    <div class="priceSummery">
                        <span class="label">Delivery </span>
                        <span>FREE</span>
                    </div> 
                    <div class="priceSummery font-weight-bold">
                        <span class="label">Order Total </span>
                        <span>Rs {{number_format($totalPrice, 2, '.', ',')}}</span>
                    </div>                                        
                </div>
                <div class="">
                <a href="/cart/checkout" class="proceedtoShipBtn btn allBtnStyle">Proceed To Shipping</a>
                </div>                                                           
            </div>

            <div class="couponBox boxShadow mt-4">
                <div class="brandCoupon">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Enter Coupon Code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">Apply Coupon</button>
                        </div>
                    </div>                    
                </div>                
            </div>
            @endif
        </div>        
    </div>
</div>


<!-- CartItemsArea End-->

@endsection

