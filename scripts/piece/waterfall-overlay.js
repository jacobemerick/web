$(function() {
    var $instance = $('.album a').imageLightbox({
        onStart: function() {
            $('<div id="imagelightbox-overlay"></div>').appendTo('body');
            $('<a href="#" id="imagelightbox-close">x</a>').appendTo('body').on('click touchend', function() {
                $(this).remove();
                $instance.quitImageLightbox();
                return false;
            });
        },
        onEnd: function() {
            $('#imagelightbox-overlay').remove();
            $('#imagelightbox-caption').remove();
            $('#imagelightbox-close').remove();
            //$('#imagelightbox-loading').remove();
        },
        onLoadStart: function() {
            $('#imagelightbox-caption').remove();
            //$('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
        },
        onLoadEnd: function() {
            var description = $('a[href="' + $('#imagelightbox').attr('src') + '"] img').attr('alt');
            if (description.length > 0) {
                $('<div id="imagelightbox-caption">' + description + '</div>').appendTo('body');
            }
            //$('#imagelightbox-loading').remove();
        }
    });
});