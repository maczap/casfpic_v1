(function ($) {
 "use strict";

// Mobile Menu
 $(document).ready(function () {
     $("#respMenu").aceResponsiveMenu({
         resizeWidth: '767', // Set the same in Media query
         animationSpeed: 'fast', //slow, medium, fast
         accoridonExpAll: false //Expands all the accordion menu on click
     });
 });

// Sticky Menu
var wind = $(window);
var sticky = $('#sticky-header');
wind.on('scroll', function(){
    var scroll = wind.scrollTop();
    if (scroll < 60) {
        sticky.removeClass('sticky-menu');
    }else{
        $('#sticky-header').addClass('sticky-menu');
    }
});

/* Testimonial
-----------------------*/
$('.testimonial-active').owlCarousel({
    // rtl:true,
    loop:true,
    dots:false,
    nav:true,
    dots: true,
    navText:['<i class="fas fa-chevron-left"></i>','<i class="fas fa-chevron-right"></i>'],
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    autoplay:true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    mouseDrag: false,
    smartSpeed:2000,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        768:{
            items:1
        },
        992:{
            items:1
        }
    }
})

/* Slider
-----------------------*/
$('.consult-slider-active').owlCarousel({
    loop:true,
    nav:false,
    dots:true,
    animateIn: 'fadeIn',
    animateOut: 'fadeOut',
    autoplay: true,
    autoplayTimeout: 3000,
    autoplayHoverPause:true, // autoplay stop after mouseover
    mouseDrag: false, // mouse drag stop
    smartSpeed: 2000,
    navText:['<i class="flaticon-left-arrow"></i>','<i class="fa flaticon-right-arrow"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        768:{
            items:1
        },
        1000:{
            items:1
        }
    }
})



/* tooltip
-----------------------*/
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

/* scrollToTop
---------------------------- */ 
$(window).scroll(function(){
    if($(this).scrollTop() > 200){
        $('.scrollToTop').fadeIn();
    }else{
        $('.scrollToTop').fadeOut();
    }
});
$('.scrollToTop').click(function(){
    $('html,body').animate({scrollTop: 0}, 1000)
});



})(jQuery); 



