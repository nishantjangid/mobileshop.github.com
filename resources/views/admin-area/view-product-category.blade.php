@include('sweet::alert')
<?php
$i=0;
?>
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin-area"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">View Product Category</li>
    </ol>
</nav>

<div class="admin-container">
    <div class="formContainer boxShadow">
        <div class="col-lg-12">
                @if(session('alertWrong'))
                    <div class="alert alert-danger alert-box alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{session('alertWrong')}}</strong>.
                    </div>
                @endif
            <div class="formHeading contentHeading text-center pb-4">
                <h3>View Product Category</h3>
            </div>
            <div class="text-center">
                <table class="table table-bordered table-responsive order-column stripe bg-light" id="viewProducts">
                    <thead>
                        <tr>
                            <td>S. No.</td>
                            <td>Product Category Name</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proCat as $items)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$items->name}}</td>
                            <td class="d-flex justify-content-between">
                                <span><a href="edit-product-category/{{$items->id}}"> <i class="fa fa-pencil text-success"></i> </a></span>
                                <span><a href="delete-product-category/{{$items->id}}"> <i class="fa fa-trash text-danger "></i> </a></span>
                            </td>                        
                        </tr>
                        @endforeach
                    </tbody>                
                </table>                
            </div>
        </div>
    </div>    
</div>
