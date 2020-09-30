
/* ====================================================================================
|   |   |   |   |   |   |   admin-chat - slider
=====================================================================================*/
$(document).ready(function (){
    "use strict";
    $("#admin-chat .right-section .top-bar i").click(function(){
        $("#admin-chat .chat-box .left-section").animate({ left: 0} , 200);
        $("#admin-chat .chat-box .overlay").css("display" , "block");
    });
    $("#admin-chat .chat-box .left-section .top-bar i").click(function(){
        $("#admin-chat .chat-box .left-section").animate({ left: -245} , 200);
        $("#admin-chat .chat-box .overlay").css("display" , "none");
    });
    $("#admin-chat .chat-box .overlay").click(function(){
        $("#admin-chat .chat-box .left-section").animate({ left: -245} , 200);
        $("#admin-chat .chat-box .overlay").css("display" , "none");
    });

});
/* ====================================================================================
|   |   |   |   |   |   |   admin-nav
=====================================================================================*/
$(document).ready(function (){
    "use strict";
    $(".admin-nav .nav-item a").hover(function(){

        $(this).siblings(".absolute").fadeIn();

        }, function(){

            $(this).siblings(".absolute").fadeOut();

      });


});  
/* ====================================================================================
|   |   |   |   |   |   |   drop-down-menu 
=====================================================================================*/
$(document).ready(function (){
    "use strict";
    $(".profile-info .user-setting i").click(function (){
        $(".drop-down-menu").fadeIn();
    });
    $(".drop-down-menu").click( function (){
        $(this).fadeOut();
    });
    $(".drop-down-menu-inner").click( function (e){
        e.stopPropagation();
    });
});
/* ====================================================================================
|   |   |   |   |   |   |   hide placeholder at focus 
=====================================================================================*/
$(document).ready(function (){
    "use strict";
    //  Hide placeholder
    $("[placeholder]").focus(function(){
        $(this).attr("data-type", $(this).attr('placeholder'));
        $(this).attr("placeholder","");
    });
    //  show placeholder
    $("[placeholder]").blur(function(){
        $(this).attr("placeholder", $(this).attr('data-type'));
    });
});



/* ====================================================================================
|   |   |   |   |   |   |   show / hidden password
=====================================================================================*/
$(document).ready(function (){
    "use strict";

    $("input.Quantity-box").change( function(){
        var Quantity = $(this).val();
        var price = $(this).parents('tr').find(".price > span ").html();
        $(this).parents('tr').find(".total_price > span ").html( Quantity * price );

    });


});
/* ====================================================================================
|   |   |   |   |   |   |   show / hidden password
=====================================================================================*/
$(document).ready( function (){
    "use strict";


    $(" i.fa-eye-slash").click( function (){
        $(this).hide();
        $(this).siblings("i.fa-eye").show();
        $(this).siblings(".form_control").attr("type" , "text");
    });

    $("i.fa-eye").click( function (){
        $(this).hide();
        $(this).siblings("i.fa-eye-slash").show();
        $(this).siblings(".form_control").attr("type" , "password");
    });

});
/* ====================================================================================
|   |   |   |   |   |   |   messege-box 
=====================================================================================*/
$(document).ready( function (){
    "use strict";
    $("#messege-icon i.fa-sms").click( function (){
        $("#messege-icon i.fa-sms").css("display" , "none");
        $("#messege-box").css("display" , "block");
    });
    $(".fa-times").click( function (){
        $("#messege-icon i.fa-sms").fadeIn();
        $("#messege-box").css("display" , "none");
    });
});
/* ====================================================================================
|   |   |   |   |   |   |   Change Like Button at writing
=====================================================================================*/
$(document).ready( function () {
    "use strict";
    $('.keyboard-section input').on("focus keyup",function() {
        if ($(this).val() == '') { // check if value changed
            $(".keyboard-section .fa-paper-plane").css("display", "none");
            $(".keyboard-section .fa-thumbs-up").css("display", "inline");
        }
    });
    $('.keyboard-section input').on("keyup",function() {
        if ($(this).val() !== '') { // check if value changed
            $(".keyboard-section .fa-paper-plane").css("display", "inline");
            $(".keyboard-section .fa-thumbs-up").css("display", "none");
        }
    });

});
/* ====================================================================================
|   |   |   |   |   |   |   drop-down-menu 
=====================================================================================*/
$(document).ready(function (){
    "use strict";
    $("#category-page #nav_mob").click(function (){
        $("#category-page .custom-dropdown").toggleClass("hidden");
    });

});
/* ====================================================================
|   |   |   |   |   |   |   scroll-to-top
===================================================================== */
$(function () {
    var btn = $('#scroll-to-top');
    $(window).scroll(function() {
        if ($(window).scrollTop() > 600) {
            btn.fadeIn();
        } else {
            btn.fadeOut();
        }
    });
    btn.click(function(){
        $('html,body').animate({
            scrollTop: 0
        }, 900);
    });
    btn.click(function(){
        $(this).animate({bottom: '50px'}, 200);
        $(this).animate({bottom: '30px'}, 200);
        $(this).animate({bottom: '50px'}, 200);
    });
});
/* ====================================================================================
|   |   |   |   |   |   |   file lable 
=====================================================================================*/
$(document).ready(function (){
    "use strict";
    $(document).on("change" , ".upload-input #file" , function (){
        var image_name = $(".upload-input #file").val();
        $(".upload-input #file-label").text(image_name);
    });
});

/* ====================================================================================
|   |   |   |   |   |   |   Are You Sure 
=====================================================================================*/

$(document).ready(function (){
    "use strict";
    $(".checked-btn").click(function (){
        return confirm("Are you Sure ?");
    });
});
/* ====================================================================================
|   |   |   |   |   |   |    Cart-page
=====================================================================================*/
$(document).ready(function (){
    "use strict";
    $(".cart-buttons a.buy_now ").click(function (){
        $("#carts-page .carts-section").fadeOut();
        $("#carts-page  .buyer-section").fadeIn();
    });
    $(".buyer-info-buttons a.cart_page ").click(function (){
        $("#carts-page .carts-section").fadeIn();
        $("#carts-page  .buyer-section").fadeOut();
    });
});

/*====================================================
                        TESTIMONIALS
====================================================*/
$(function () {

    $(".products_section .items-rows").owlCarousel({
        responsive:{
            300:{
                items: 1
            },
            577:{
                items: 2
            },
            960:{
                items: 3
            },
            1200:{
                items: 4
            }
        },
        margin: 10,
        nav: true,
        loop: true,
        autoplayHoverPause: true,
        autoplay: true,
        smartSpeed: 900,
        autoplayTimeout: 3500,
    });
});

/*====================================================
                        Add Cart
====================================================*/
$(function () {
    "use strict";

    $(".item-buttons .add_cart").click(function () {

        var itemid = $(this).attr("itemid");

        $.ajax({
            type: "POST",
            url: "includes/ajax/add_cart.php",
            data: { "itemid": itemid},
            dataType: "JSON",
            success: function (feedback) {

                if( feedback.status == "successfully" ){

                    $(".overlay-white-alert.loading").css("display", "block");
                    show_numCart();
                    setTimeout(function(){
                        $(".overlay-white-alert.loading").css("display", "none");
                    }, 2000);

                }if( feedback.status == "error" ){

                    alert("Error add to cart");

                }if( feedback.status == "maximum" ){

                    $(".overlay-white-alert.maximum-alert").css("display", "block");
                    setTimeout(function(){
                        $(".overlay-white-alert.maximum-alert").css("display", "none");
                    }, 2000);


                }if( feedback.status == "exsit" ){

                    $(".overlay-white-alert.exist-alert.cart").css("display", "block");
                    setTimeout(function(){
                        $(".overlay-white-alert.exist-alert.cart").css("display", "none");
                    }, 2000);


                }

            }
        });


    });


    /*====================================================
                            Get num of carts
    ====================================================*/


        function show_numCart(){
            var show_numCart = "true"; 
            $.ajax({
                type: "GET",
                url: "includes/ajax/show_numCart.php",
                data: { "show_numCart" : show_numCart},
                success: function (feedback) {
                    if( feedback > 9 ){
                        $(".navbar .red_circle.cart ").html("+9");
                    }else{
                        $(".navbar .red_circle.cart ").html(feedback);
                    }
                }
            });
        }

    

    /*====================================================
                    Add Favorite
    ====================================================*/

        
    $(".item-buttons .add_favorite").click(function () {

        var itemid = $(this).attr("itemid");

        $.ajax({
            type: "POST",
            url: "includes/ajax/add_favorite.php",
            data: { "itemid": itemid},
            dataType: "JSON",
            success: function (feedback) {

                if( feedback.status == "successfully" ){

                    $("overlay-white-alert.loading").css("display", "block");
                    show_numFavorite();
                    setTimeout(function(){
                        $("overlay-white-alert.loading").css("display", "none");
                    }, 2000);

                }if( feedback.status == "error" ){

                    alert("error add to favorite ");

                }if( feedback.status == "exsit" ){

                    $(".overlay-white-alert.exist-alert.favourite").css("display", "block");
                    setTimeout(function(){
                        $(".overlay-white-alert.exist-alert.favourite").css("display", "none");
                    }, 2000);


                }

            }
        });


    });
    /*====================================================
                            Get num of favorite
    ====================================================*/


    function show_numFavorite(){
        var show_numFavorite = "true"; 
        $.ajax({
            type: "GET",
            url: "includes/ajax/show_numFavorite.php",
            data: { "show_numFavorite" : show_numFavorite},
            success: function (feedback) {
                if( feedback > 9 ){
                    $(".navbar .red_circle.favorites").html("+9");
                }else{
                    $(".navbar .red_circle.favorites").html(feedback);
                }
            }
        });
    }



    /*====================================================
                            delete Cart
    ====================================================*/
    $("#carts-page .fa-window-close").click(function () {



        var itemid = $(this).attr("itemid");

        $.ajax({
            type: "POST",
            url: "includes/ajax/delete_cart.php",
            data: { "itemid": itemid},
            dataType: "JSON",
            success: function (feedback) {

                if( feedback.status == "successfully" ){

                    $(".overlay-white-alert.loading").css("display", "block");
                    setTimeout(function(){
                        window.location.href = 'carts.php';
                    }, 2000);

                }if( feedback.status == "error" ){

                    alert("error at delete cart");

                }

            }
        });

    });


    /*====================================================
                            delete Favourite
    ====================================================*/
    $("#favourite-page .delete-favourite .fa-times-circle").click(function () {

        var itemid = $(this).attr("itemid");

        $.ajax({
            type: "POST",
            url: "includes/ajax/delete_favorite.php",
            data: { "itemid": itemid},
            dataType: "JSON",
            success: function (feedback) {

                if( feedback.status == "successfully" ){
                    $(".overlay-white-alert.loading").css("display", "block");
                    setTimeout(function(){
                        window.location.href = 'favourites.php';
                    }, 2000)
                }if( feedback.status == "error" ){
                    alert("error at delete cart");
                }

            }
        });

    });

    /* ====================================================================================
    |   |   |   |   |   |   |   Check seeion is client 
    =====================================================================================*/
    if ( sessionlogin == 1 ){
        

        /* ====================================================================================
        |   |   |   |   |   |   |   Chat =====> Send Message for client 
        =====================================================================================*/

        $("#messege-box #send-messege").keypress(function (e) { 
            if(e.keyCode == 13){
                var send_message = $("#send-messege").val();
                if( send_message != ""){
                    
                    $.ajax({
                        type: "POST",
                        url: "includes/ajax/send_messege_client.php",
                        data: { send_message: send_message},
                        dataType: "JSON",
                        success: function (feedback) {
                            if(feedback.status == "success"){
                                $("#send-messege").val('');
                                show_messeges_client();
                                $("#messege-icon .messege-section").animate({scrollTop :  $(".messege-section")[0].scrollHeight } , 1000);
                            }
                            if( feedback.status == "error" ){

                                
                            }
                        }
                    });
                }
            }
        });
        $("#messege-box .keyboard-section .fa-paper-plane").click(function () { 
            var send_message = $("#send-messege").val();
            if( send_message != ""){
                
                $.ajax({
                    type: "POST",
                    url: "includes/ajax/send_messege_client.php",
                    data: { send_message: send_message},
                    dataType: "JSON",
                    success: function (feedback) {
                        if(feedback.status == "success"){
                            $("#send-messege").val('');
                            show_messeges_client();
                            $("#messege-icon .messege-section").animate({scrollTop :  $(".messege-section")[0].scrollHeight } , 1000);
                        }
                        if( feedback.status == "error" ){

                        }
                    }
                });

            }
        });

        

        /* ====================================================================================
        |   |   |   |   |   |   |   Chat =====> Send images for client
        =====================================================================================*/

        $("#messege-box .content-icon #file ").change( function (){
            var file_name = $(".content-icon #file").val();
            if( file_name.length != "" ){

                $.ajax({
                    type: "POST",
                    url: "includes/ajax/send_files_client.php",
                    data: new FormData( $(" .content-icon ")[0] ),
                    contentType: false,
                    processData: false,
                    success: function (feedback) {
                        if( feedback == "Unvalidate file"){

                        }
                        if( feedback == "error connection"){

                        }
                        if( feedback == "file sent"){
                            show_messeges_client();
                            $("#messege-icon .messege-section").animate({scrollTop :  $(".messege-section")[0].scrollHeight } , 1000);
                        }
                    }
                });

            }
        });


        /* ====================================================================================
        |   |   |   |   |   |   |   Chat =====>  Send Like for client
        =====================================================================================*/
        $("#messege-box .fa-thumbs-up").click(function () {
            var like = $(this).attr("class");

                $.ajax({
                    type: "POST",
                    url: "includes/ajax/send_like_client.php",
                    data: { "send_like": like},
                    dataType: "JSON",
                    success: function (feedback) {

                        if( feedback.status == "error" ){

                        }if( feedback.status == "success" ){
                            show_messeges_client();
                            $(".chat-area").animate({scrollTop :  $(".messege-section")[0].scrollHeight } , 1000);
                        }

                    }
                });

        });



        


        /* ====================================================================================
        |   |   |   |   |   |   |   Chat =====>  Show Messeges for client
        =====================================================================================*/

        function show_messeges_client(){
            var msg = "true"; 
            $.ajax({
                type: "GET",
                url: "includes/ajax/show_messeges_client.php",
                data: { "messege" : msg},
                success: function (feedback) {
                    $("#messege-box .messege-section .messeges-area").html(feedback);
                }
            });
        }

        show_messeges_client();

        setInterval(function (){
            show_messeges_client();
        }, 3000);





    }
    
    


    /* ====================================================================================
    |   |   |   |   |   |   |   Check seeion is admin 
    =====================================================================================*/
    if ( sessionlogin == 2 ){

        var URL = window.location.href;
        
        if( URL.includes("admin") ){
                
            /* ====================================================================================
            |   |   |   |   |   |   |   Chat =====> Send Message for admin 
            =====================================================================================*/

            $("#admin-chat #send-messege").keypress(function (e) { 
                if(e.keyCode == 13){
                    var send_message = $("#send-messege").val();
                    if( send_message != ""){
                        $.ajax({
                            type: "POST",
                            url: "../includes/ajax/send_messege_admin.php",
                            data: { send_message: send_message},
                            dataType: "JSON",
                            success: function (feedback) {
                                if(feedback.status == "success"){
                                    $("#send-messege").val('');
                                    show_messeges_admin();
                                }
                                if( feedback.status == "error" ){

                                    
                                }
                            }
                        });
                    }
                }
            });
            $("#admin-chat .keyboard-section .fa-paper-plane").click(function () { 
                var send_message = $("#send-messege").val();
                if( send_message != ""){
                    
                    $.ajax({
                        type: "POST",
                        url: "../includes/ajax/send_messege_admin.php",
                        data: { send_message: send_message},
                        dataType: "JSON",
                        success: function (feedback) {
                            if(feedback.status == "success"){
                                $("#send-messege").val('');
                                show_messeges_admin();
                            }
                            if( feedback.status == "error" ){

                            }
                        }
                    });

                }
            });
            /* ====================================================================================
            |   |   |   |   |   |   |   Chat =====> Send images for admin
            =====================================================================================*/

            $("#admin-chat .content-icon #file ").change( function (){
                var file_name = $(".content-icon #file").val();
                if( file_name.length != "" ){

                    $.ajax({
                        type: "POST",
                        url: "../includes/ajax/send_files_admin.php",
                        data: new FormData( $(" .content-icon ")[0] ),
                        contentType: false,
                        processData: false,
                        success: function (feedback) {
                            if( feedback == "Unvalidate file"){

                            }
                            if( feedback == "error connection"){

                            }
                            if( feedback == "file sent"){
                                show_messeges_admin();
                            
                            }
                        }
                    });

                }
            });


            /* ====================================================================================
            |   |   |   |   |   |   |   Chat =====>  Send Like for admin
            =====================================================================================*/
            $("#admin-chat .fa-thumbs-up").click(function () {
                var like = $(this).attr("class");

                    $.ajax({
                        type: "POST",
                        url: "../includes/ajax/send_like_admin.php",
                        data: { "send_like": like},
                        dataType: "JSON",
                        success: function (feedback) {

                            if( feedback.status == "error" ){

                            }if( feedback.status == "success" ){
                                show_messeges_admin();
                                
                            }

                        }
                    });

            });


            /* ====================================================================================
            |   |   |   |   |   |   |   Chat =====>  Show Messeges for admin
            =====================================================================================*/


            function show_messeges_admin(){
                var msg = "true"; 
                $.ajax({
                    type: "GET",
                    url: "../includes/ajax/show_messeges_admin.php",
                    data: { "messege" : msg},
                    success: function (feedback) {
                        $("#admin-chat .messege-section .messeges-container").html(feedback);
                    }
                });
            }
        
            show_messeges_admin();
        
            setInterval(function (){
                show_messeges_admin();
            }, 3000);


            /* ====================================================================================
            |   |   |   |   |   |   |   Chat =====>  Show slider clients for admin
            =====================================================================================*/


            function show_slider_clients(){
                var msg = "true"; 
                $.ajax({
                    type: "GET",
                    url: "../includes/ajax/show_slider_clients.php",
                    data: { "messege" : msg},
                    success: function (feedback) {
                        $("#admin-chat .left-section .clients-messages").html(feedback);
                    }
                });
            }
        
            show_slider_clients();
        
            setInterval(function (){
                show_slider_clients();
            }, 3000);






            /* ====================================================================================
            |   |   |   |   |   |   |   seen massege 
            =====================================================================================*/


            $(".clients-messge-box").click(function () {  

                var clientID = $(this).attr("clientID");

                $.ajax({
                    type: "POST",
                    url: "../includes/ajax/seen_messege.php",
                    data: { "clientID": clientID},
                    dataType: "JSON",
                    success: function (feedback) {

                    }
                });
            });




            $(".keyboard-section .keyboard-input").focus(function () {  

                var clientID = $(this).attr("clientID");
                setInterval(function (){

                    $.ajax({
                        type: "POST",
                        url: "../includes/ajax/seen_messege.php",
                        data: { "clientID": clientID},
                        dataType: "JSON",
                        success: function ( feedback) {

                        }
                    });
                    
                }, 3000);


            });

            $(".chat-box .right-section").on("click mouseover hover mouseleave mouseenter scroll" , function () {

                var clientID = $(".keyboard-section .keyboard-input").attr("clientID");
                setInterval(function (){

                    $.ajax({
                        type: "POST",
                        url: "../includes/ajax/seen_messege.php",
                        data: { "clientID": clientID},
                        dataType: "JSON",
                        success: function (feedback) {

                        }
                    });
                    
                }, 3000);

            });



        }
        
    }
    
    
});
