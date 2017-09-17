$(document).ready(function () {


    //------------------------------------//
    //Navbar//
    //------------------------------------//
    var menu = $('.navbar');
    $(window).bind('scroll', function (e) {
        if ($(window).scrollTop() > 50) {
            if (!menu.hasClass('open')) {
                menu.addClass('open');
            }
        } else {
            if (menu.hasClass('open')) {
                menu.removeClass('open');
            }
        }
    });


    //------------------------------------//
    //Scroll To//
    //------------------------------------//
    $(".scroll").click(function (event) {
        event.preventDefault();
        $('html,body').animate({
            scrollTop: $(this.hash).offset().top
        }, 800);

    });

    //------------------------------------//
    //Wow Animation//
    //------------------------------------// 
    wow = new WOW({
        boxClass: 'wow', // animated element css class (default is wow)
        animateClass: 'animated', // animation css class (default is animated)
        offset: 0, // distance to the element when triggering the animation (default is 0)
        mobile: false // trigger animations on mobile devices (true is default)
    });
    wow.init();
    //------------------------------------//
    //Slider//
    //------------------------------------//
    var $item = $('.carousel .item');
    var $wHeight = $(window).height();
    $item.eq(0).addClass('active');
    $item.height($wHeight);
    $item.addClass('full-screen');
    $item.find('.wow').each(function () {
        $(this).addClass('animated');
    });
    $('.carousel img').each(function () {
        var $src = $(this).attr('src');
        var $color = $(this).attr('data-color');
        $(this).parent().css({
            'background-image': 'url(' + $src + ')',
            'background-color': $color
        });
        $(this).remove();
    });

    $(window).on('resize', function () {
        $wHeight = $(window).height();
        $item.height($wHeight);
    });

    $('.carousel').carousel({
        interval: 6000,
        pause: "false"
    });
    //------------------------------------//
    //Search//
    //------------------------------------//
    var $search = $('.search');
    $search.click(function () {
        $(this).find('.form-group').each(function () {
            $(this).addClass('show');
        });
        $(this).find('.default').css("display","none");
        $(this).find('.form-control').focus();
    });
});