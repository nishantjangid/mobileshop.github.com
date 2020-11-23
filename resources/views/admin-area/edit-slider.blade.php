@extends('admin-area/links')

@section('content')
<div class="adminpanel">
    <section id="sidebar">
        @include('admin-area/sidebar')
    </section>
    <section id="dashboard">
        <div class="dashboardHeader d-flex justify-content-between align-items-center py-2 px-5">
            <div class="Control">
                <button class="toggleBtn py-2 px-3">
                    <i class="fa fa-bars fa-2x"></i>
                </button>        
            </div>
            <div class="dashboardMenu">
                <div class="Adminprofile d-flex flex-direction-column align-items-center">
                    <div class="profileDetail px-3">
                        <h5>Jhon</h5>
                    </div>
                    <div class="profileImage">
                        <img src="{{asset('images/myimage.jpg')}}" alt="">   
                    </div>
                </div>
            </div>
        </div>  
    @include('sweet::alert')

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin-area"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Products</li>
            </ol>
        </nav>

        <div class="admin-container">
            <div class="formContainer boxShadow">
                <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                    <div class="formHeading contentHeading text-center pb-4">
                        <h3>Edit Product</h3>
                    </div>
                    <form action="{{route('slider.update',$slider->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="text" class="form-control" name="slider_title" placeholder="Enter Product Title" value="{{$slider->slider_title}}">
                        </div>     
                        <div class="form-group">
                            <input type="text" class="form-control" name="slider_url" placeholder="Enter Product Price" value="{{$slider->slider_url}}">
                        </div> 
                        <div class="form-group w-100">
                            <input type="file" class="form-control" name="slider_image" value="">
                            <img src="/{{$slider->slider_image}}" alt="{{$slider->slider_image}}" class="w-100">
                        </div>                                                               
                        <div class="text-center">
                        <input type="hidden" name="id" value="{{$slider->slider_id}}">
                            <button type="submit" name="submit" class="allBtnStyle">Update</button>
                        </div>      
                    </form>        
                </div>
            </div>    
        </div>

    </section>
</div>

@endsection