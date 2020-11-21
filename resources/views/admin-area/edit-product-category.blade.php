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


        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin-area"><i class="fa fa-home"></i> Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Update Product Category</li>
            </ol>
        </nav>

        <div class="admin-container">
            <div class="formContainer boxShadow">
                <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                    <div class="formHeading contentHeading text-center pb-4">
                        <h3>Update Product Category</h3>
                    </div>
                    <form action="/admin-area/updateProductCategory" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="category_name" placeholder="Enter Product Title" value="{{$proCat->name}}">
                        </div>                                                     
                        <div class="text-center">
                        <input type="hidden" name="id" value="{{$proCat->id}}">
                            <button type="submit" name="submit" class="allBtnStyle">Update</button>
                        </div>      
                    </form>        
                </div>
            </div>    
        </div>

    </section>
</div>

@endsection