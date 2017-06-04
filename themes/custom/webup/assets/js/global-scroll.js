var WEBUP_Global_Scroll = (function ($) {
  return {
    init: function () {
      $(window).resize(this.resize);
      this.resize();

      this.ie = WEBUP_Global.detectIeBrowser();
      /*
       * Anim on scroll on every components
       */
      if(this.ie > 9 || undefined == this.ie){
        this.initScrollReveal();
      }
    },

    resize: function() {
      $w = $(window).width();
      if($w>1200){
        $(window).unbind('scroll');
        $(window).bind('scroll', this.windowScroll);
      }else{
        $(window).unbind('scroll', this.windowScroll);
      }

      $(window).bind('scroll', this.initInfiniteScroll);
    },

    parallaxBackground: function() {
      var topWindow = $(window).scrollTop();

      this.parallax($('.banner-visual'), topWindow);
      this.parallax($('.spotlight-visual'), topWindow);
      this.parallax($('.block-media-visual'), topWindow);
    },

    parallax: function(elt, topWindow) {
      if(elt.length){
        var top = (topWindow - elt.offset().top)/2;
        elt.css("top",  top + "px");
      }
    },

    /*
     * Window scroll handler
     */
    windowScroll: function() {

      // display sticky menu
      if ($(window).scrollTop() > 50) {
        $('body').addClass('header-fixed');
      } else {
        $('body').removeClass('header-fixed');
      }

      // push up aside
      if ($(window).scrollTop() + $(window).height() > $('.footer').offset().top) {
        $('.aside').addClass('aside-hide');
      }else{
        $('.aside').removeClass('aside-hide');
      }
      //WEBUP_Global_Scroll.parallaxBackground();
    },

    initScrollReveal: function(){
      window.sr = ScrollReveal({
        scale: 1,
        distance: '100px',
        delay: 1.5,
        duration: 1500,
        useDelay: 'always',
        reset: true,
        easing: 'cubic-bezier(0, 0.63, 0.41, 0.98)',
        beforeReveal: function(domEl){
          if($(domEl).hasClass('block-numbers')){
            WEBUP_Global_Scroll.initBlocNumbers();
          }
        },
        afterReveal: function (domEl) {
          $(domEl).attr('style','');
        }
      });
      sr.reveal('#comments-list');
      sr.reveal('.block-text');
      sr.reveal('.path-blog .blog-item');
    },

    initBlocNumbers: function(){
          $('.counter').each(function(){
              var f_val = parseInt($(this).text());
              var count_id = $(this).attr('id');

              var options = {
                  useEasing : true,
                  separator : ''
              };

              if(!isNaN(f_val)){
                  var count_anim = new CountUp(count_id, 0, f_val, 0, 2, options);
                  count_anim.start();
              }
          });
      },

    initInfiniteScroll: function(){
      // reach bottom
      if(Math.ceil($(window).scrollTop() + $(window).height()) >= $(document).height()
      && $('div.infinite-scroll  div.row > div').length < $('#insight_total').val()) {
        WEBUP_Global_Scroll.doInfiniteScroll();
      }
    },

    doInfiniteScroll: function(){
      if($('.infinite-scroll').length && !$('.loader').length){
        $('.infinite-scroll').append('<div class="loader"><svg class="circular" viewBox="25 25 50 50"><circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/></svg></div>');
        $.ajax($(location).attr('pathname') + "?loadM=1&start=" + $('div.infinite-scroll  div.row > div').length +"&limit=3", {
          success: function(data) {
              $('.loader').remove();
              $('.infinite-scroll .row').append(data);

              if(WEBUP_Global_Scroll.ie > 9 || undefined == WEBUP_Global_Scroll.ie){
                window.sr.reveal('.infinite-scroll .item-webinar, .infinite-scroll .item-insight, .infinite-scroll .push-article');
              }

          }
        });
      }
    }
  };
})(jQuery);
