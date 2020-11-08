@extends('layout')

@section('content')
<div class="FixedTopMargin">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">My Account</li>
        </ol>
    </nav>  
    <div class="row">
        @include('sweet::alert')
        <div class="col-md-3 col-sm-12">
            <div class="boxShadow">
                <div class="customerMenu">
                    <h3>My Account</h3>
                    <ul>
                        <li><a href="/myaccount">Personal Information</a></li>
                        <li><a href="/myaccount/delete-account">Delete Account</a></li>
                        <li><a href="/help">Help</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9 col-sm-12">
            <div class="formContainer allSectionMargin  boxShadow" id="customerProfileForm">
                <div class="formHeading contentHeading text-center">
                    <h3>Personal Information</h3>
                </div>
                <form action="/registration" method="post" id="customerformUpdate">
                    @csrf
                    <div class="form-group">
                    <input type="text" class="form-control" value="{{$customerinfo['username']}}" name="username" placeholder="Enter Your Username" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" value="{{$customerinfo['email']}}" name="email" placeholder="Enter Your Email" required>
                    </div>
                    <div class="form-group">
                        <span>if you want to change your password simply click on <b class="changePasswordBtn">Change Password</b><span>
                        <input type="password" class="form-control passwordInput hideInput" value="" name="password" placeholder="Enter New Password" required>
                    </div> 
                    <div class="form-group">
                        <input type="text" class="form-control" value="{{$customerinfo['mobile']}}" name="mobile" placeholder="Enter Your Mobile" required>
                    </div>             
                    <div class="form-group">
                        <textarea class="form-control" name="address" placeholder="Enter Your Address" required>{{$customerinfo['address']}}</textarea>
                    </div>            
                    <div class="text-center">
                        <button type="submit" name="submit" class="allBtnStyle customerUpdateBtn">Update</button>
                    </div>      
                </form>        
            </div>
        </div>    
    </div>
</div>


@endsection