$(document).ready(function(){

    //home page slider 
    $('.home-slider').slick({
        autoplay:true,
        autoplaySpeed:2000,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        fade: true,
        cssEase: 'linear',
        mobilFirst:true
    });
    // LatestProductOwlCarousel

    $('.demo').slick({
        prevArrow:'<button type="button" data-role="none" class="slick-prev">Previous</button>',
        nextArrow:'<button type="button" data-role="none" class="slick-next">Next</button>',
        autoplay:true,
        // autoplaySpeed: 1000,
        pauseOnHover:true,
        pauseOnFocus:true,
        waitForAnimate:true,

        
    });
    // ProductImageZoom
    $('#productSlider').zoom({ on:'click' });    

    //product Image view on click
    $('.SampleImage').on('click', function(){
        const sampleIndex = $(this).attr('data-index');
        const BigIndex = $('.slick-slide').find(`[data-slick-index=${sampleIndex}]`).addClass('slick-current slick-active');
        console.log(BigIndex);
    });


    $("#owl-demo").owlCarousel({
 
        autoPlay: 1500, //Set AutoPlay to 1,5 seconds
        items : 4,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        itemsMobile : [786,3]
   
    });  
    
    // LatestProductFilter
    $('.filterBtn').click(function(){
        const value = $(this).attr('data-filter');
        if(value=="All")
        {
            $('.galleryImage').show(1500);
        }
        else
        {
            $('.galleryImage').not('.'+value).hide(1500);
            $('.galleryImage').filter('.'+value).show(1500);
        }
    });
    $('.filterBtn').click(function(){
        $(this).addClass('btnActive').siblings().removeClass('btnActive');
    });

    
    $('.nav-item').click(function(){
        $(this).addClass('navActive').siblings().removeClass('navActive');
    });    

    // ProductPriceRangeFilter
    $('#priceRange').change(function(){
        $(".range").html($(this).val());
    });

    const priceRange = () => {

        const params = new URLSearchParams(window.location.search);
        $('#priceRange').empty();
        $('.range').empty();
        $('#priceRange').val(params.get('pricerange'));
        $('.range').text(params.get('pricerange'));
    }

    if(location.search != "")
    {
        priceRange();

    }
    
    // ProductDetailSlider
    $("#productDetailSlider").owlCarousel({
 
         //Set AutoPlay to 1,5 seconds
        // autoPlay:2500,
        
        items : 1,
        stopOnHover : true,
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        lazyLoad : true,
        nav:true,
   
        // "singleItem:true" is a shortcut for:
        // items : 1, 
        // itemsDesktop : false,
        // itemsDesktopSmall : false,
        // itemsTablet: false,
        // itemsMobile : false
   
    });    



    // ProductQuantity
    var proQty = 1;
    $('#qtyAdd').click(function(){
        // console.log("outer"+proQty);
        if(proQty<5)
        {
            ++proQty;
            console.log(proQty);    
            $('.proQtyInput').empty();
            $('.proQtyInput').val(proQty);
        }
        else
        {
            alert('You reach the maximum limit of product');
        }
    });
    $('#qtyMinus').click(function(){
        
        if(proQty<=5 && proQty>1)
        {
            --proQty;
            console.log(proQty);    
            $('.proQtyInput').empty();
            $('.proQtyInput').val(proQty);
        }
        else
        {
            alert('Atleat 1 quantity is must');
        }
    });    

    $('[name=brand]').click(function(){
        if(this.checked)
        {
            const value = $(this).attr('data-filter');
            if(value=="All")
            {
                $('.galleryImage').show(1500);
            }
            else
            {
                $('.galleryImage').not('.'+value).hide(1500);
                $('.galleryImage').filter('.'+value).show(1500);
            }
        }
        else
        {
            $('.galleryImage').show(1500);
        }

    });

        
    //to delete cart item
    $('#cartDeleteBtn').on('click', function(event){
        event.preventDefault();
        const url = $(this).attr('href');
        console.log(url);
        swal({
            title: 'Are you sure?',
            text: 'This record and it`s details will be permanantly deleted!',
            icon: 'warning',
            buttons: ["Cancel", "Yes!"],
        }).then(function(value) {
            if (value) {
                window.location.href = url;
            }
        });
    });

    //change price on change quantity
    $('.product_qty').on('change',function(event){
        event.preventDefault();
        const proId = $(this).attr("data-product_id");
        const quantity = $(this).val();
        const _token = $('[name=_token]').val();
        console.log(_token);
        if(quantity != "")
        {
            $.ajax({
                url:"changePrice",
                method:"POST",
                data:{ proId : proId, quantity : quantity, _token: _token},
                success : function (response){
                    if(response == 1)
                    {
                        
                        location.reload();
                    }
                    else{
                        swal({
                            title: 'Something is wrong',
                            text: 'Your cart is not updated',
                            icon: 'danger',
                        });                   
                    }
                }
            });
        }
    });

    //customer profile update
    $('.changePasswordBtn').on('click', function(e){
        e.preventDefault();
        $('.passwordInput').removeClass('hideInput');
    });
    $('.customerUpdateBtn').on('click', function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url : 'customerUpdate',
            method : 'POST',
            data : {
                username : $('[name=username]').val(),
                email : $('[name=email]').val(),
                password : $('[name=password]').val(),
                mobile : $('[name=mobile]').val(),
                address : $('[name=address]').val(),
                _token : $('[name=_token]').val()

            },
            success : function (response){
                if(response == 1)
                {
                    swal({
                        title: 'Success',
                        text: 'Your Profile Updated Successfully',
                        icon: 'success',
                    });
                }
                else{
                    swal({
                        title: 'Opps',
                        text: 'Something wrong',
                        icon: 'warning',
                        buttons: ["Cancel", "Yes!"],
                    });                    
                }

            }

        });
    });

    //Product detail image onclick change

    // const showImage = (imgName) => {
    //     const curImage = document.getElementById('currentImg');  
    //     console.log(imgName);
    //     const theSource = imgName;
    //     console.log(theSource);
    //     curImage.src = theSource;
    //     curImage.alt = imgName;
    //     curImage.title = imgName;
    // }
    // showImage(imgName);

});
