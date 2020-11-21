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
        @if((request()->is('admin-area')))
            @include('admin-area/dashboard')
        @elseif(request()->is('admin-area/insert-products'))
            @include('admin-area/insert-products')
        @elseif(request()->is('admin-area/view-products'))
            @include('admin-area/view-products')
        @elseif(request()->is('admin-area/edit-product'))
            @include('admin-area/edit-product')
        @elseif(request()->is('admin-area/view-product-category'))
            @include('admin-area/view-product-category') 
        @elseif(request()->is('admin-area/insert-product-category'))
            @include('admin-area/insert-product-category')          
        @elseif(request()->is('admin-area/view-slider'))  
            @include('admin-area/view-slider')          
        @elseif(request()->is('admin-area/insert-slider'))  
            @include('admin-area/insert-slider')
        @endif

    </section>
</div>

@endsection