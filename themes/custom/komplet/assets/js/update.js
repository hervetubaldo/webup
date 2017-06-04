var tab_item = new Array();
jQuery(document).ready(function ($) {
  'use strict';
  var arr_src = new Array();
  var i = 0;
  $('.komplet-section-portfolio-single > .komplet-bg-get-src').each(function () {
    arr_src[i] = $(this).attr('data-bg-src');
    i++;

  });
  if ($('.komplet-section-portfolio-single > .komplet-bg-get-src').length) {
    $('#headerwrap').backstretch(arr_src, {
      duration: 8000,
      fade: 500
    });
  }

});
jQuery(window).load(function () {
  "use strict";
  jQuery(function () {
    jQuery(".player").mb_YTPlayer();
  });
  jQuery('.player-controls a').on('click', function (event) {
    event.preventDefault();
  });
  jQuery('a.vol').on('click', function (event) {
    var $this = jQuery(this).children('i');
    if ($this.hasClass('fa-volume-off')) {
      $this.removeClass('fa-volume-off').addClass('fa-volume-up');
    } else {
      $this.removeClass('fa-volume-up').addClass('fa-volume-off');
    }
  });
});
jQuery(document).ready(function () {
  if (jQuery('#countdown').length) {
    var date = jQuery('#countdown').attr('data-date');
    // set the date we're counting down to
    var target_date = new Date(date).getTime();
    var days, hours, minutes, seconds;
    var countdown = document.getElementById('countdown');
    setInterval(function () {
      var current_date = new Date().getTime();
      var seconds_left = (target_date - current_date) / 1000;
      days = parseInt(seconds_left / 86400);
      seconds_left = seconds_left % 86400;
      hours = parseInt(seconds_left / 3600);
      seconds_left = seconds_left % 3600;
      minutes = parseInt(seconds_left / 60);
      seconds = parseInt(seconds_left % 60);
      countdown.innerHTML = '<span class="days">' + days + ' <small>Days</small></span> <span class="hours">' + hours + ' <small>Hours</small></span> <span class="minutes">' + minutes + ' <small>Minutes</small></span> <span class="seconds">' + seconds + ' <small>Seconds</small></span>';
    }, 1000);
  }
  var j = 0;
  jQuery('#menu-tabs > .komplet-tab-item').each(function () {


    tab_item[j] = $(this).attr('data-id');

    j++;

  });
  for (var i = 0; i < tab_item.length; i++) {

    jQuery('#komplet-content-av-wrapper .tab-content').append('<div class="tab-pane fade in" id="' + tab_item[i] + '" role="tabpanel"><div class="tab-inner"><div class="row"></div></div></div>');
  }

  for (var i = 0; i < tab_item.length; i++) {
    jQuery('#komplet-content-av > .' + tab_item[i]).each(function () {
      var _content = jQuery(this).html();
      jQuery('#komplet-content-av-wrapper > .tab-content #' + tab_item[i] + ' .tab-inner > .row').append(_content);
    });

  }

  jQuery('#menu-tabs > .komplet-tab-item').first().addClass('active');
  jQuery('#komplet-content-av-wrapper > #tabs-collapse > .tab-pane').first().addClass('active');
  jQuery('#komplet-content-av').remove();

  jQuery("ul.dropdown-menu").find('> li.dropdown-submenu').click(
    function (e) {
      var width = jQuery(window).width();
      if (width <= 750) {
        e.stopPropagation()

        $(this).find('> ul').slideToggle();

        // $(this).find('> ul').toggle();
      }

    }
  );

  jQuery(window).resize(function () {
    var width = jQuery(window).width();
    if (width > 750) {
      jQuery('#main-navigation .navbar-nav > .dropdown.menu-item--expanded > .dropdown-menu > .dropdown-submenu.menu-item--expanded > .dropdown-menu').removeAttr("style");
    }
  });
});
