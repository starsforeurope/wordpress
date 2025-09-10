jQuery(document).ready(function($){
   
    var slider_auto, slider_loop, slider_control, rtl, slider_animation;
    
    /** Variables from Customizer for Slider settings */
    if( benevolent_data.auto == '1' ){
        slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( benevolent_data.loop == '1' ){
        slider_loop = true;
    }else{
        slider_loop = false;
    }
    
    if( benevolent_data.pager == '1' ){
        slider_control = true;
    }else{
        slider_control = false;
    }
    if( benevolent_data.rtl == '1' ){
        rtl = true;
    }else{
        rtl = false;
    }

    if( benevolent_data.animation == 'slide' ){
        slider_animation = '';
    }else{
        slider_animation = 'fadeOut';
    }
    
    /** Home Page Slider */
    $("#banner-slider").owlCarousel({
        items           : 1,
        margin          : 0,
        loop            : slider_loop,
        autoplay        : slider_auto,
        nav             : false,
        dots            : slider_control,
        animateOut      : slider_animation,
        autoplayTimeout : benevolent_data.speed,
        lazyLoad        : true,
        mouseDrag       : false,
        rtl             : rtl,
        autoplaySpeed   : benevolent_data.a_speed,
    });
   
   $('.number').counterUp({
        delay: 10,
        time: 5000
    });

   //Responsive navigation
   $('.main-navigation').prepend('<span class="close"></span>');
   $('#mobile-header').on( 'click', function() {
    $('body').addClass('menu-toggled');
   });

   $('.close').on( 'click', function() {
    $('body').removeClass('menu-toggled');
   });

   //secondary responsive menu
   $('.secondary-navigation').clone().insertBefore('.header-bottom');
   $('#secondary-mobile-header').on( 'click', function() {
    $(this).parents('.header-top').siblings('.secondary-navigation').slideToggle();
   });

   $('.main-navigation ul li.menu-item-has-children, .secondary-navigation ul li.menu-item-has-children').prepend('<span class="submenu-toggle"><i class="fas fa-chevron-down"></i></span>');
   
   $('.submenu-toggle').on( 'click', function() {
    $(this).toggleClass('active');
    $(this).siblings('ul').slideToggle();
   });

   //mobile menu
    $('.menu-opener').on( 'click', function() {
      $('body').addClass('menu-open');
    });

    $('.btn-menu-close').on( 'click', function() {
     $('body').removeClass('menu-open');
    });

   $('.overlay').on( 'click', function() {
    $('body').removeClass('menu-open');
   });

   $('<button class="angle-down"></button>').insertAfter($('.mobile-menu ul .menu-item-has-children > a'));
    $('.mobile-menu ul li .angle-down').on( 'click', function() {
        $(this).next().slideToggle();
        $(this).toggleClass('active');
    });

   $('.secondary-menu ul .menu-item-has-children').append('<button class="angle-down"></button>');
   $('.secondary-menu ul li .angle-down').on( 'click', function() {
      $(this).prev().slideToggle();
      $(this).toggleClass('active');
   });

   //secondary menu accibility for edge
   $(".secondary-navigation ul li a").on( 'focus', function() {
       $(this).parents("li").addClass("focus");
   }).on( 'blur', function() {
       $(this).parents("li").removeClass("focus");
   });

   $(".main-navigation ul li a").on( 'focus', function() {
       $(this).parents("li").addClass("focus");
   }).on( 'blur', function() {
       $(this).parents("li").removeClass("focus");
   });
    /*  Navigation Accessiblity
     --------------------------------------------- */
    $(document).on('mousemove', 'body', function (e) {
        $(this).removeClass('keyboard-nav-on');
    });
    $(document).on('keydown', 'body', function (e) {
        if (e.which == 9) {
            $(this).addClass('keyboard-nav-on');
        }
    }); 

});

// Angledown Accessibility
