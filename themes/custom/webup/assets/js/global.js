 var WEBUP_Global = (function ($) {
    return {
        init: function () {
            WEBUP_Global_Scroll.init();
        },

        getDomain: function(){
            var $logo = $('header .logo');
            logo_class = $logo.attr('class').split(' ');
            logo_domain = logo_class[1].replace('logo-', '');

            return logo_domain;
        },

        detectIeBrowser: function(){
            var undef,
            v = 3,
            div = document.createElement('div'),
            all = div.getElementsByTagName('i');

            while (
                div.innerHTML = '<!--[if gt IE ' + (++v) + ']><i></i><![endif]-->',
                all[0]
            );

            return v > 4 ? v : undef;
        }
    };
})(jQuery);
