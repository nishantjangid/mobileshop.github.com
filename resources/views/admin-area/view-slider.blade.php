@include('sweet::alert')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/admin-area"><i class="fa fa-home"></i> Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">View Sliders</li>
    </ol>
</nav>

<div class="admin-container">
    <div class="formContainer boxShadow">
        <div class="col-md-10 offset-md-1 col-sm-10 offset-sm-1">
            <div class="formHeading contentHeading text-center pb-4">
                <h3>View Sliders</h3>
            </div>
            <div class="row">
                @foreach ($slider as $item)
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">                    
                    <div class="sliderBox boxShadow mb-3">
                        <div class="sliderImage w-100 h-100">
                        <img src="../{{$item->slider_image}}" alt="image-name" class="w-100 h-100">
                        </div>
                        <div class="d-flex flex-direction-row justify-content-between align-items-center p-4">
                        <a href="{{route('slider.edit',$item->id)}}" class="text-success font-weight-bold h4 text-decoration-none"><i class="fa fa-fw fa-pencil"></i> Edit</a>
                        <form action="{{route('slider.destroy',$item->id)}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-danger font-weight-bold h4 text-decoration-none"><i class="fa fa-fw fa-trash"></i> Delete</button>
                        </form>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
        </div>
    </div>    
</div>
