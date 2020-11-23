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
            <li class="breadcrumb-item active" aria-current="page">Update Products</li>
            </ol>
        </nav>

        <div class="admin-container">
            <div class="formContainer boxShadow">
                <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                        @if(session('alertWrong'))
                            <div class="alert alert-danger alert-box alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong>This Email {{session('alertWrong')}} already exists </strong>.
                            </div>
                        @endif
                    <div class="formHeading contentHeading text-center pb-4">
                        <h3>Update Product</h3>
                    </div>
                    <form action="/admin-area/updateProduct" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="product_title" placeholder="Enter Product Title" value="{{$product->product_title}}">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="product_url" placeholder="Enter Product Url" value="{{$product->product_url}}">
                        </div>                        
                        <div class="form-group">
                            <select name="category_id" id="" class="form-control">
                                <option value="" disabled selected>Select brand</option> 
                                @foreach ($catData as $item)
                                    <option value="{{$item->id}}" @if($product->category_id == $item->id) selected @endif>{{$item->name}}</option>
                                @endforeach
                            </select>
                        </div>        
                        <div class="form-group">
                            <textarea class="form-control" id="textarea" name="product_description" placeholder="Enter Product Description" rows="4">{{$product->product_description}}</textarea>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price" value="{{$product->product_price}}">
                        </div> 
                        <div class="form-group">
                            <input type="text" class="form-control" name="product_discount" placeholder="Enter Product Discount Price" value="{{$product->product_discount}}">
                        </div>                 
                        <div class="form-group">
                            <input type="file" class="form-control" name="product_img1">
                            <img src="/{{$product->product_img1}}" alt="" height="100" width="100">
                        </div>             
                        <div class="form-group">
                            <input type="file" class="form-control" name="product_img2" >
                            <img src="/{{$product->product_img2}}" alt="{{$product->product_img2}}" height="100" width="100">
                        </div> 
                        <div class="form-group">
                            <input type="file" class="form-control" name="product_img3" >
                            <img src="/{{$product->product_img3}}" alt="{{$product->product_img3}}"height="100" width="100">
                        </div> 
                        <div class="form-group">
                            <input type="file" class="form-control" name="product_img4" >
                            <img src="/{{$product->product_img4}}" alt="{{$product->product_img4}}" height="100" width="100">
                        </div>                           
                        <div class="form-group">
                            <input type="text" class="form-control" name="product_label" placeholder="Enter Product Label" value="{{$product->product_label}}">
                        </div>                                               
                        <div class="text-center">
                        <input type="hidden" name="id" value="{{$product->id}}">
                            <button type="submit" name="submit" class="allBtnStyle">Update</button>
                        </div>      
                    </form>        
                </div>
            </div>    
        </div>

    </section>
</div>

@endsection