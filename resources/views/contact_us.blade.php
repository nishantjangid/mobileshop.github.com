@extends('layout')

@section('content')

@if(session('alertSuccess'))
    @include('sweet::alert')
@endif
<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Contact Us</li>
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
                <h3>Contact form</h3>
                <p>If you have any query you can feel free to contact us.</p>
            </div>
            <form action="/contactus" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Enter Your Full Name..." autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email..." autocomplete="off" required>
                </div>
                <div class="form-group">
                    <textarea name="message" id="" class="form-control" placeholder="Message.."></textarea>
                </div>  
                <div class="text-center">
                    <button type="submit" name="submit" class="allBtnStyle loginBtn">Send</button>                    
                </div>      
            </form>   
    
        </div>
    </div>
</div>

@endsection