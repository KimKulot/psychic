(function($) {
    $(document).ready(function () {
        //Portfolio carousel
        $(".portfolio-carousel").flexCarousel({
            breakPoints:[[1200, 4], [998, 3], [768, 2], [530, 1]],
            pagination:false,
            navigationText:['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            navigation:true
        });

        // hide show list item
        $('.js-hide').on('click', function (e) {
            e.preventDefault();
            $(this).closest('li').toggleClass('active').find('p').toggleClass('active');
            $(this).find('.fa').toggleClass('fa-minus').toggleClass('fa-plus')
        });

        // scroll top
        $('body').on('click', '.js-scroll a', function(e){
            var linkTarget = $(this).attr('href');

            if(linkTarget.indexOf('http') !== 0 && location.pathname === '/'){
                e.preventDefault();
                var linkId = linkTarget.replace('/', '');
                $('html, body').animate({scrollTop:$(linkId).position().top}, 2000);
            }

        });

        // vertical line active

        function activeVerticalLine(element) {
            if(element.length > 0){
                var offset = element.offset(),
                    offsetTop = offset.top;

                $(document).scroll(function() {
                    var scrollTopElement = $(this).scrollTop();
                    if((offsetTop + element.height()) >= scrollTopElement && scrollTopElement >= offsetTop - 50){
                        //active
                        element.find('.v-line').addClass('active');
                        element.find('.js-g-line').addClass('active');
                    } else	 if (scrollTopElement < (offsetTop + element.height())) {
                        //default
                        element.find('.v-line').removeClass('active');
                        element.find('.js-g-line').removeClass('active');

                    }
                });
            }

        }
        var element1 = $('.js-active-line-first');
        var element2 = $('.js-active-line-second');
        var element3 = $('.js-active-line-third');
        var element4 = $('.js-active-line-fourth');
        activeVerticalLine(element1);
        activeVerticalLine(element2);
        activeVerticalLine(element3);
        activeVerticalLine(element4);

        // show menu
        $('.js-show-menu').click(function (e) {
            e.preventDefault();
            $(this).toggleClass('active').closest('.header-top')
                .find('.menu').toggleClass('active');
        });
    })

})(jQuery);
