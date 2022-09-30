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