/**
 * ?Admin panel javascript
 * !Author : Nishant Jangid
 */
$(document).ready(function(){
    $('.parentMenu1').on('click',function(){
        $('.sidebarBody ul li>ul').toggleClass('childMenu1');
        $('ul li.parentMenu1 span i').toggleClass('fa-arrow-up fa-arrow-down');

    });
    $('.parentMenu2').on('click',function(){
        $('.sidebarBody ul li>ul').toggleClass('childMenu2');
        $('ul li.parentMenu2 span i').toggleClass('fa-arrow-up fa-arrow-down');

    }); 
    $('.parentMenu3').on('click',function(){
        $('.sidebarBody ul li>ul').toggleClass('childMenu3');
        $('ul li.parentMenu3 span i').toggleClass('fa-arrow-up fa-arrow-down');

    });      
    
    //header menu button
    $('.toggleBtn').on('click', function(){
        // $('#sidebar').toggle(
        // function(){$('#sidebar').css('width','0%')}, 
        // function(){$('#sidebar').css('width','25%')});
        $('.dashboardHeader .Control button i').toggleClass('fa fa-bars fa-2x fa fa-times fa-2x')
        $('#sidebar').toggleClass('sidebar-collapse');
    });


    $('#viewProducts').DataTable({
        "lengthMenu": [5, 10, 20, 100, 500],
        'theme': 'energyblue',
    });

    // tinymce.init({
    //     selector:'#textarea',
    //     height: 500,
    //     menubar: false,
    //     plugins: [
    //         'advlist autolink lists link image charmap print preview anchor',
    //         'searchreplace visualblocks code fullscreen',
    //         'insertdatetime media table paste code help wordcount'
    //     ],
    //     toolbar: 'undo redo | formatselect | ' +
    //     'bold italic backcolor | alignleft aligncenter ' +
    //     'alignright alignjustify | bullist numlist outdent indent | ' +
    //     'removeformat | help',
    //     content_css: '//www.tiny.cloud/css/codepen.min.css'
    // });



})