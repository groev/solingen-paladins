"use strict";

jQuery(document).ready(function ($) {
  jQuery(".menu-toggle img").click(function () {
    jQuery("body").toggleClass("menu-visible");
  });
  $(".game-grid").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    responsive: [{
      breakpoint: 800,
      // tablet breakpoint
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  $(".slider-inner").slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    dots: true,
    arrows: true,
    responsive: [{
      breakpoint: 800,
      // tablet breakpoint
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  $(".news-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    arrows: true,
    responsive: [{
      breakpoint: 800,
      // tablet breakpoint
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }]
  });
  jQuery(".menu-item-has-children > a").click(function (e) {
    e.preventDefault();

    if (jQuery(this).parent().hasClass("visible")) {
      jQuery(this).parent().removeClass("visible");
    } else {
      jQuery(this).parent().addClass("visible");
    }
  });
});

window.onscroll = function () {
  myFunction();
}; // Get the header


var header = document.getElementById("header"); // Get the offset position of the navbar

var sticky = header.offsetTop; // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position

function myFunction() {
  if (window.pageYOffset > sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}