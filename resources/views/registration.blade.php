@extends('layout')

@section('content')
<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Registration</li>
        </ol>
    </nav> 
    <div class="formContainer">
        <div class="col-md-6 offset-md-3 col-sm-10 offset-sm-1">
                @if(session('alertWrong'))
                    <div class="alert alert-danger alert-box alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>This Email {{session('alertWrong')}} already exists </strong>.
                    </div>
                @endif
            <div class="formHeading contentHeading text-center">
                <h3>Registration form</h3>
            </div>
            <form action="/registration" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Enter Your Username" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Enter Your Password" required>
                </div> 
                <div class="form-group">
                    <input type="text" class="form-control" name="mobile" placeholder="Enter Your Mobile" required>
                </div>             
                <div class="form-group">
                    <textarea class="form-control" name="address" placeholder="Enter Your Address" required></textarea>
                </div>            
                <div class="text-center">
                    <button type="submit" name="submit" class="allBtnStyle RegisBtn">Registration</button>
                    <p>If you already registered <a href="/login">click here</a>?</p>
                </div>      
            </form>        
        </div>
    </div>
</div>


@endsection