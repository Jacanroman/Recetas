import 'owl.carousel';

require('./bootstrap');


//JQuery for the heart animation

$('.like-btn').on('click', function() {
    $(this).toggleClass('like-active');
 });


 /** CAROUSEL CON OWL */
 
 jQuery(document).ready(function(){
     //alert('funciona');
     jQuery('.owl-carousel').owlCarousel({
        margin:10,
        loop:true,
        autoplay:true,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:3
            }
        }
     })
 });