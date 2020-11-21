@include('sweet::alert')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin-area"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Insert Slider</li>
    </ol>
</nav>

<div class="admin-container">
    <div class="formContainer boxShadow">
        <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1">
            <div class="formHeading contentHeading text-center pb-4">
                <h3>Insert Slider</h3>
            </div>
        <form action="{{route('slider.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="slider_title" placeholder="Enter Slider Name">
                </div>            
                <div class="form-group">
                    <input type="text" class="form-control" name="slider_url" placeholder="Enter Slider Url">
                </div>            
                <div class="form-group">
                    <input type="file" class="form-control" name="slider_image">
                </div>                                                                                      
                <div class="text-center">
                    <button type="submit" name="submit" class="allBtnStyle">Submit</button>
                </div>      
            </form>        
        </div>
    </div>    
</div>
