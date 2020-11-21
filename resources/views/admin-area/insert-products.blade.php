@include('sweet::alert')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin-area"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Insert Products</li>
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
                <h3>Insert Product</h3>
            </div>
            <form action="/insertProducts" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="product_title" placeholder="Enter Product Title">
                </div>
                <div class="form-group">
                    <select name="category_id" id="" class="form-control">
                        <option value="" disabled selected>Select brand</option> 
                        @foreach ($catData as $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>        
                <div class="form-group">
                <textarea class="form-control" id="textarea" name="product_description" placeholder="Enter Product Description" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price">
                </div> 
                <div class="form-group">
                    <input type="text" class="form-control" name="product_discount" placeholder="Enter Product Discount Price">
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
</div>
