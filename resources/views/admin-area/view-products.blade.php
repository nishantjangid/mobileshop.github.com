@include('sweet::alert')
<?php
$i=0;
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin-area"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">View Products</li>
    </ol>
</nav>

<div class="admin-container">
    <div class="formContainer boxShadow">
        <div class="col-lg-12">
                @if(session('alertWrong'))
                    <div class="alert alert-danger alert-box alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>This Email {{session('alertWrong')}} already exists </strong>.
                    </div>
                @endif
            <div class="formHeading contentHeading text-center pb-4">
                <h3>View Products</h3>
            </div>
            <table class="table table-bordered table-responsive order-column stripe bg-light" id="viewProducts">
                <thead>
                    <tr>
                        <td>S. No.</td>
                        <td>Product Name</td>
                        <td>Product Brand</td>
                        <td>Product Description</td>
                        <td>Product Price</td>
                        <td>Product Image</td>
                        <td>Product Label</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $items)
                    <tr>
                        <td>{{++$i}}</td>
                        <td>{{$items->product_title}}</td>
                        <td>
                            @foreach($catData as $catItems)
                                @if($catItems->id == $items->category_id)
                                    {{$catItems->name}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{$items->product_description}}</td>
                        <td>{{ number_format($items->product_price,2,'.',',')}}</td>
                        <td><img src="../{{$items->product_img1}}" alt="" height="100" width="100"></a></td>
                        <td>{{$items->product_label}}</td>
                        <td class="d-flex justify-content-between">
                        <span><a href="edit-product/{{$items->id}}"> <i class="fa fa-pencil text-success"></i> </a></span>
                            <span><a href="delete-product/{{$items->id}}"> <i class="fa fa-trash text-danger "></i> </a></span>
                        </td>                        
                    </tr>
                    @endforeach
                </tbody>                
            </table>
        </div>
    </div>    
</div>
