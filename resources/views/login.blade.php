@extends('layout')

@section('content')
<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Login</li>
        </ol>
    </nav> 
    <div class="formContainer">
        <div class="col-md-6 offset-md-3 col-sm-10 offset-sm-1">
            <div class="formHeading contentHeading text-center">
            
            @include('sweet::alert')
                    

                @if(session('alertWrong'))
                    <div class="alert alert-danger alert-box alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{session('alertWrong')}}</strong>.
                    </div>
                @endif            
                <h3>Login form</h3>
            </div>
            <form action="/login" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Enter Your Password" autocomplete="off" required>
                </div>  
                <div class="text-center">
                    <button type="submit" name="submit" class="allBtnStyle loginBtn">Login</button>
                    <p>If you don't registered yet <a href="/registration">click here</a>?</p>
                </div>      
            </form>        
        </div>
    </div>
</div>

@endsection