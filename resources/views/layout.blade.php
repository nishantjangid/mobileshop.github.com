<?php
use App\Http\Controllers\ProductController;

$total = 0;
if(Session::has('user'))
{
  $total = ProductController::cartItem();
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>

    <!-- all additional files are here -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/font-awesome.min.css')}}">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>
<body>
<!-- Header goes here... -->
<div class="header fixed-top">
@section('header')
<div class="UserPanel">
  <div class="d-flex justify-content-end ">
      @if(Session::has('user'))
  <a href="javascript:void(0);" class="UserActionBtn">Hi {{Session::get('user')->username}}</a>
      <a href="/logout" class="UserActionBtn">Sign Out  <i class="fa fa-power-off"></i></a>
      @else
      <a href="/login" class="UserActionBtn">Sign In</a>
      <a href="/registration" class="UserActionBtn">Registration</a>
      @endif

  </div>
</div>  
  <nav class="navbar navbar-expand-lg  navbar-light">
    <a class="navbar-brand" href="/">Mobee Shop</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ml-auto pr-3">
        <a class="nav-item nav-link  navActive" href="/">Home <span class="sr-only">(current)</span></a>
        <a class="nav-item nav-link" href="/shop">Shop</a>
        <a class="nav-item nav-link" href="/create">Contact Us</a>
        <a class="nav-item nav-link" href="/myaccount">My Account</a>        
        <a class="nav-item nav-link" href="/cart">Cart <i class="fa fa-shopping-cart"></i> ({{$total}})</a>
      </div>
      <form class="form-inline" action="/search" method="get">
        <input class="form-control mr-sm-2" type="search" name="q" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>    
    </div> 
  </nav> 
@show
</div>
<!-- Content goes here... -->
  <div class="content">
  @yield('content')    
  </div>
<!-- Footer goes here... -->
@section('footer')
<footer id="footer">
    <div class="row">
      <div class="col-sm-12 col-md-12 col-lg-3">
        <div class="footerHeading">
          <h3>Mobee Shop</h3>
        </div>
        <div class="footerDetail">
          <a href="#">Who We Are</a>
          <a href="#">Join Our Team</a>
          <a href="#">Terms & Conditions</a>
          <a href="#">We Respect Your Privacy</a>
          <a href="#">Fee & Payments</a>
          <a href="#">Refund & Refunds Policy</a>
          <a href="#">Promotions Terms & Conditions</a>
        </div>
      </div>
      <div class="col-sm-12 col-md-12 col-lg-3">
      <div class="footerHeading">
          <h3>Help</h3>
        </div>
        <div class="footerDetail">
          <a href="#">Track Your Order</a>
          <a href="#">Frequently Asked Questions</a>
          <a href="#">Returns</a>
          <a href="#">Cancellations</a>
          <a href="#">Payments</a>
          <a href="#">Customer Care</a>
          <a href="#">How Do I Reedam My Coupon?</a>
        </div>        
      </div>
      <div class="col-sm-12 col-md-12 col-lg-3">
      <div class="footerHeading">
          <h3>Shop By</h3>
        </div>
        <div class="footerDetail">
          <a href="/shop">Samsung</a>
          <a href="/shop">Xaomi</a>
          <a href="/shop">Oppo</a>
          <a href="/shop">Lava</a>
          <a href="/shop">Nokia</a>
          <a href="/shop">Redmi</a>
          <a href="/shop">I Phone</a>
        </div>        
      </div>
      <div class="col-sm-12 col-md-12 col-lg-3">
      <div class="footerHeading">
          <h3>Follow us</h3>
        </div>
        <div class="footerDetail">
          <a href="#">Linkedin</a>
          <a href="#">Facebook</a>
          <a href="#">Twitter</a>
          <a href="#">Instagram</a>
          <a href="#">Pinterest</a>
        </div>        
      </div>
      <div class="col-md-12 col-lg-12 col-12">
        <div id="copyright">
          <p>&copy; copywrite All right reserve 2020-21. Mobee Shop </p>
        </div>
      </div>
    </div>
</footer>
@show

<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery.zoom.js')}}"></script>
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
</body>
</html>