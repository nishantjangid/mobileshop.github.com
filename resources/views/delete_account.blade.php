@extends('layout')

@section('content')
<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Delete Account</li>
        </ol>
    </nav>  
    <div class="row">
        @include('sweet::alert')

        <div class="col-md-3 col-sm-12">
            @include('account_sidebar')
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="boxShadow accountDeleteBx"> 
                <div class="text-center">
                    <h3>Delete Account ?</h3>
                </div>      
                <div class="customerActionBtn text-center">
                    <a href="/deleteAccount" class="allBtnStyle accountDelete">Yes</a>
                    <a href="/myaccount" class="allBtnStyle">No</a>
                </div>
            </div>
        </div>    
    </div>
</div>


@endsection