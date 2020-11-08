@extends('layout')

@section('content')
@include('sweet::alert')

<?php

$unitTotalPrice = 0;
$totalDiscount = 0;
$totalPrice = 0;
foreach($cartDetail as $items)
{
$salePrice = $items->product_price-$items->product_discount;
$actualPrice = $items->product_price;

$qty = $items->qty;
// echo $qty;
$salePrice = ($salePrice * $qty);
$actualPrice = ($actualPrice * $qty);
$unitTotalPrice += $items->product_price*$qty;
$totalDiscount += $items->product_discount;
$totalPrice = $unitTotalPrice-$totalDiscount;
}
?>

<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item" aria-current="page">Payment</li>
            </ol>
    </nav>
</div>
<!-- CartItemsArea Start-->
<div id="cartWrapper">    
    <div class="alert alert-primary mx-4" role="alert" style="font-size: 1.5rem">
        <b>Note:</b> If you want to change Delivery Address just simply click here <a href="/myaccount" class="alert-link">Change Address</a>
    </div>
    <div class="row">         
        <div class="col-lg-9 col-md-12 col-sm-12 ">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12" style="padding: 0 !important;">
                    <div class="nav flex-column nav-pills boxShadow" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-cod" role="tab" aria-controls="v-pills-home" aria-selected="true">Cash On Delivery</a>
                    <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-netbanking" role="tab" aria-controls="v-pills-profile" aria-selected="false">Net Banking</a>
                    <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-credit-debit" role="tab" aria-controls="v-pills-messages" aria-selected="false">Credit / Debit Card</a>
                    <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-upi" role="tab" aria-controls="v-pills-settings" aria-selected="false">UPI</a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12" style="padding: 0 !important;">
                    <div class="tab-content boxShadow" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-cod" role="tabpanel" aria-labelledby="v-pills-home-tab">
                            <div class="codPanel">
                                <form action="/finalpayment" method="POST">
                                    <h4>Cash on Delivery</h4>
                                    <p>For safe, contactless, and hassle free delivery, pay using card/wallet/netbanking</p>
                                    @csrf
                                    <input hidden name="payment_method" value="Cash On Delivery">
                                    <button type="submit" class="btn allBtnStyle mb-2">Place Order</button><br>
                                    <span>By placing this order, you agree to AJIO's T&C</span>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-netbanking" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            panel 2
                        </div>
                        <div class="tab-pane fade" id="v-pills-credit-debit" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                            <script src="https://js.stripe.com/v3/"></script>

                            <form action="/stripePayment" method="post" id="payment-form">
                                {{csrf_field()}}
                            <div class="form-row">
                                <input hidden name="total_price" value="{{$totalPrice}}">
                                <input hidden name="name" value="{{Session::get('user')->username}}">
                                <input hidden name="email" value="{{Session::get('user')->email}}">
                                <input hidden name="mobile" value="{{Session::get('user')->mobile}}">
                                <label for="card-element">
                                    Credit or debit card
                                    </label>
                                <div id="card-element" class="form-control">
                                <!-- A Stripe Element will be inserted here. -->
                                </div>
                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                                <span>By placing this order, you agree to AJIO's T&C</span>

                            </div>

                            <button type="submit" class="btn allBtnStyle stripeBtn" style="padding: 1rem 1.5rem;margin: 2rem 0;font-size: 1.5rem;">Pay Securely</button>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="v-pills-upi" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                            panel 4
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
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
                        <span>Rs {{ number_format($totalPrice, 2, '.', ',')}}</span>
                    </div>                                        
                </div>                                                          
            </div>

        </div>         
      
    </div>
</div>


<!-- CartItemsArea End-->

<!-- stripe payment script -->
<script>
    var stripe = Stripe('pk_test_51HTJMjKEJ7PNXUvYkPD87mikXpH6tKNzJCmLdExio713R2c7rfWSunQKPju2TziGCH5tCnFlzuvb0H3az27eh4B200FaIt5PRH');

// Create an instance of Elements.
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};

// Create an instance of the card Element.
var card = elements.create('card', {style: style});

// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');

// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});

// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();

  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});

// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);

  // Submit the form
  form.submit();
}
</script>

@endsection

