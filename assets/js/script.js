(function($){

    $.extend($.easing, {
        easeInOutCubic : function(x, t, b, c, d){
            if ((t/=d/2) < 1) return c/2*t*t*t + b;
            return c/2*((t-=2)*t*t + 2) + b;
        }
    });

    $.fn.outerFind = function(selector){
        return this.find(selector).addBack(selector);
    };

    // (function($,sr){
    //     var debounce = function (func, threshold, execAsap) {
    //         var timeout;

    //         return function debounced () {
    //             var obj = this, args = arguments;
    //             function delayed () {
    //                 if (!execAsap) func.apply(obj, args);
    //                 timeout = null;
    //             };

    //             if (timeout) clearTimeout(timeout);
    //             else if (execAsap) func.apply(obj, args);

    //             timeout = setTimeout(delayed, threshold || 100);
    //         };
    //     }
    //     // smartresize 
    //     jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

    // })(jQuery,'smartresize');

    (function(){
        
        var scrollbarWidth = 0, originalMargin, touchHandler = function(event){
            event.preventDefault();
        };

        function getScrollbarWidth(){
            if (scrollbarWidth) return scrollbarWidth;
            var scrollDiv = document.createElement('div');
            $.each({
                top : '-9999px',
                width  : '50px',
                height : '50px',
                overflow : 'scroll', 
                position : 'absolute'
            }, function(property, value){
                scrollDiv.style[property] = value;
            });
            $('body').append(scrollDiv);
            scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth;
            $('body')[0].removeChild(scrollDiv);
            return scrollbarWidth;
        }

    })();

    $.isMobile = function(type){
        var reg = [];
        var any = {
            blackberry : 'BlackBerry',
            android : 'Android',
            windows : 'IEMobile',
            opera : 'Opera Mini',
            ios : 'iPhone|iPad|iPod'
        };
        type = 'undefined' == $.type(type) ? '*' : type.toLowerCase();
        if ('*' == type) reg = $.map(any, function(v){ return v; });
        else if (type in any) reg.push(any[type]);
        return !!(reg.length && navigator.userAgent.match(new RegExp(reg.join('|'), 'i')));
    };

    var isSupportViewportUnits = (function(){
        // modernizr implementation
        var $elem = $('<div style="height: 50vh; position: absolute; top: -1000px; left: -1000px;">').appendTo('body');
        var elem = $elem[0];
        var height = parseInt(window.innerHeight / 2, 10);
        var compStyle = parseInt((window.getComputedStyle ? getComputedStyle(elem, null) : elem.currentStyle)['height'], 10);
        $elem.remove();
        return compStyle == height;
    }());

    $(function(){

        $('html').addClass($.isMobile() ? 'mobile' : 'desktop');

        // .azz-navbar--sticky
        $(window).scroll(function(){
            $('.azz-navbar--sticky').each(function(){
                var method = $(window).scrollTop() > 10 ? 'addClass' : 'removeClass';
                $(this)[method]('azz-navbar--stuck')
                    .not('.azz-navbar--open')[method]('azz-navbar--short');
            });
        });

        // .azz-hamburger
        $(document).on('add.cards change.cards', function(event){
            $(event.target).outerFind('.azz-hamburger:not(.azz-added)').each(function(){
                $(this).addClass('azz-added')
                    .click(function(){
                        $(this)
                            .toggleClass('azz-hamburger--open')
                            .parents('.azz-navbar')
                            .toggleClass('azz-navbar--open')
                            .removeClass('azz-navbar--short');
                    }).parents('.azz-navbar').find('a:not(.azz-hamburger)').click(function(){
                        $('.azz-hamburger--open').click();
                    });
            });
        });
        // $(window).smartresize(function(){
        //     if ($(window).width() > 991)
        //         $('.azz-navbar--auto-collapse .azz-hamburger--open').click();
        // }).keydown(function(event){
        //     if (27 == event.which) // ESC
        //         $('.azz-hamburger--open').click();
        // });

        // if ($.isMobile() && navigator.userAgent.match(/Chrome/i)){ // simple fix for Chrome's scrolling
        //     (function(width, height){
        //         var deviceSize = [width, width];
        //         deviceSize[height > width ? 0 : 1] = height;
        //         $(window).smartresize(function(){
        //             var windowHeight = $(window).height();
        //             if ($.inArray(windowHeight, deviceSize) < 0)
        //                 windowHeight = deviceSize[ $(window).width() > windowHeight ? 1 : 0 ];
        //             $('.azz-section--full-height').css('height', windowHeight + 'px');
        //         });
        //     })($(window).width(), $(window).height());
        // } else if (!isSupportViewportUnits){ // fallback for .azz-section--full-height
        //     $(window).smartresize(function(){
        //         $('.azz-section--full-height').css('height', $(window).height() + 'px');
        //     });
        //     $(document).on('add.cards', function(event){
        //         if ($('html').hasClass('azz-site-loaded') && $(event.target).outerFind('.azz-section--full-height').length)
        //             $(window).resize();
        //     });
        // }

        // .azz-parallax-background
        if ($.fn.jarallax && !$.isMobile()){
            $(document).on('destroy.parallax', function(event){
                $(event.target).outerFind('.azz-parallax-background')
                    .jarallax('destroy')
                    .css('position', '');
            });
            $(document).on('add.cards change.cards', function(event){
                $(event.target).outerFind('.azz-parallax-background')
                    .jarallax()
                    .css('position', 'relative');
            });
        }

        // $(document).on('add.cards', function(event){
        //     $(event.target).outerFind('[data-bg-video]').each(function(){
        //         var result, videoURL = $(this).data('bg-video'), patterns = [
        //             /\?v=([^&]+)/,
        //             /(?:embed|\.be)\/([-a-z0-9_]+)/i,
        //             /^([-a-z0-9_]+)$/i
        //         ];
        //         for (var i = 0; i < patterns.length; i++){
        //             if (result = patterns[i].exec(videoURL)){
        //                 var previewURL = 'http' + ('https:' == location.protocol ? 's' : '') + ':';
        //                 previewURL += '//img.youtube.com/vi/' + result[1] + '/maxresdefault.jpg';

        //                 var $img = $('<div class="azz-background-video-preview">')
        //                     .hide()
        //                     .css({
        //                         backgroundSize: 'cover',
        //                         backgroundPosition: 'center'
        //                     })
        //                 $('.container:eq(0)', this).before($img);

        //                 $('<img>').on('load', function() {
        //                     if (120 == (this.naturalWidth || this.width)) {
        //                         // selection of preview in the best quality
        //                         var file = this.src.split('/').pop();
        //                         switch (file){
        //                             case 'maxresdefault.jpg':
        //                                 this.src = this.src.replace(file, 'sddefault.jpg');
        //                                 break;
        //                             case 'sddefault.jpg':
        //                                 this.src = this.src.replace(file, 'hqdefault.jpg');
        //                                 break;
        //                         }
        //                     } else {
        //                         $img.css('background-image', 'url("' + this.src + '")')
        //                             .show();
        //                     }
        //                 }).attr('src', previewURL)

        //                 if ($.fn.YTPlayer && !$.isMobile()){
        //                     var params = eval('(' + ($(this).data('bg-video-params') || '{}') + ')');
        //                     $('.container:eq(0)', this).before('<div class="azz-background-video"></div>').prev()
        //                         .YTPlayer($.extend({
        //                             videoURL : result[1],
        //                             containment : 'self',
        //                             showControls : false,
        //                             mute : true
        //                         }, params));
        //                 }
        //                 break;
        //             }
        //         }
        //     });
        // });

        // init
        $('body > *:not(style, script)').trigger('add.cards');
        $('html').addClass('azz-site-loaded');
        $(window).resize().scroll();

        // smooth scroll
        // if (!$('html').hasClass('is-builder')){
        //     $(document).click(function(e){
        //         try {
        //             var target = e.target;
        //             do {
        //                 if (target.hash){
        //                     var useBody = /#bottom|#top/g.test(target.hash);
        //                     $(useBody ? 'body' : target.hash).each(function(){
        //                         e.preventDefault();
        //                         // in css sticky navbar has height 64px 
        //                         var stickyMenuHeight = $('.azz-navbar--sticky').length ? 64 : 0;
        //                         var goTo = target.hash == '#bottom' 
        //                                 ? ($(this).height() - $(window).height())
        //                                 : ($(this).offset().top - stickyMenuHeight);
        //                         $('html, body').stop().animate({
        //                             scrollTop: goTo
        //                         }, 800, 'easeInOutCubic');
        //                     });
        //                     break;
        //                 }
        //             } while (target = target.parentNode);
        //         } catch (e) {
        //            // throw e;
        //         }
        //     });
        // }

    });

})(jQuery);