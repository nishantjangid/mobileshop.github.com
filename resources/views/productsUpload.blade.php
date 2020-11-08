@extends('layout')

@section('content')
<div class="formContainer">
    <div class="col-md-6 offset-md-3 col-sm-10 offset-sm-1">
            @if(session('alertWrong'))
                <div class="alert alert-danger alert-box alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>This Email {{session('alertWrong')}} already exists </strong>.
                </div>
            @endif
        <div class="formHeading contentHeading text-center">
            <h3>Product Information</h3>
        </div>
        <form action="/insertProducts" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="product_title" placeholder="Enter Product Title">
            </div>
            <div class="form-group">
                <select name="category_id" id="" class="form-control">
                    <option value="1">Samsung</option>
                    <option value="2">Oppo</option>
                    <option value="3">Vivo</option>
                    <option value="4">Iphone</option>
                    <option value="5">Xiaomi</option> 
                </select>
            </div>        
            <div class="form-group">
            <textarea class="form-control" name="product_description" placeholder="Enter Product Description"></textarea>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price">
            </div> 
            <div class="form-group">
                <input type="file" class="form-control" name="product_img1">
            </div>             
            <div class="form-group">
                <input type="file" class="form-control" name="product_img2">
            </div> 
            <div class="form-group">
                <input type="file" class="form-control" name="product_img3">
            </div> 
            <div class="form-group">
                <input type="file" class="form-control" name="product_img4">
            </div>  
            <div class="form-group">
                <input type="text" class="form-control" name="product_label" placeholder="Enter Product Label">
            </div>                                               
            <div class="text-center">
                <button type="submit" name="submit" class="allBtnStyle">Submit</button>
            </div>      
        </form>        
    </div>
</div>


@endsection