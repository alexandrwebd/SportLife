$(document).ready(function () {

    $('.header__slider').slick({
        nextArrow: '<button class="slick-arrow slick-next"><img src="/public/images/next.svg" alt="next arrow"></button>',
        prevArrow: '<button class="slick-arrow slick-prev"><img src="/public/images/prev.svg" alt="prew arrow"></button>',
        fade: true,
        infinite: true,
        autoplay: 1000,
        cssEase: 'linear',
        responsive: [
            {
                breakpoint: 576,
                settings: 'unslick'
            }
        ]
    });

    $('.services-slider').slick({
        nextArrow: '<button class="slick-arrow slick-next"><img src="/public/images/next.svg" alt="next arrow"></button>',
        prevArrow: '<button class="slick-arrow slick-prev"><img src="/public/images/prev.svg" alt="prew arrow"></button>',
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 1,
        centerMode: true,
        variableWidth: true,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '0',
                    slidesToShow: 2,
                    variableWidth: true
                }
            },
            {
                breakpoint: 480,
                settings: {
                    centerPadding: '0',
                    slidesToShow: 1,
                    variableWidth: true
                }
            }
        ]
    });

    $('.reviews__slider-inner').slick({
        nextArrow: '<button class="slick-arrow slick-next"><img src="/public/images/next.svg" alt="next arrow"></button>',
        prevArrow: '<button class="slick-arrow slick-prev"><img src="/public/images/prev.svg" alt="prew arrow"></button>',
        dots: true,
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 2,
        responsive: [
            {
                breakpoint: 1200,
                settings: {
                    centerPadding: '0',
                    slidesToShow: 2,
                    variableWidth: true
                }
            },
            {
                breakpoint: 992,
                settings: {
                    centerPadding: 20,
                    slidesToShow: 2,
                    variableWidth: false
                }
            },
            {
                breakpoint: 640,
                settings: {
                    centerPadding: 0,
                    slidesToShow: 1,
                    variableWidth: false
                }
            }
        ]

    });

    // Скрываем попап форму при первой загрузке
    $('.contacts__form-popup').hide();
    $('.popup-prices').hide();

    $('.popup__header-form, .prices-popup').magnificPopup({

        callbacks: {
            open: function () {
                // setTimeOut(function(){
                //     magnificPopup.close(); 
                //   }, 3000)
            }
        },
        preloader: true,
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });

    // Показываем поппап форму при клике на кнопку
    $('.popup__header-form').click(function () {
        $('.contacts__form-popup').show()
    });
    $('.prices-popup').click(function () {
        $('.popup-prices').show()
    });


    $('.zoom-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0, 1]
        },
        removalDelay: 300,
        mainClass: 'mfp-fade'
    });


    // Показываем мобильное меню при клике по гамбургеру с фиксацией страницы от прокрутки
    $('.header__burger').click(function (event) {
        $('.header__burger, .menu').toggleClass('active-menu');
        $('body').toggleClass('lock');
    });


    $('.gallery-popup').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: false,
        closeBtnInside: false,
        mainClass: 'mfp-with-zoom mfp-img-mobile',
        image: {
            verticalFit: true,
            titleSrc: function (item) {
                return item.el.attr('title') + ' &middot; <a class="image-source-link" href="' + item.el.attr('data-source') + '" target="_blank">image source</a>';
            }
        },
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true,
            duration: 300,
            opener: function (element) {
                return element.find('img');
            }
        }
    });

    // Инициализация wow 
    new WOW().init();

    // Добавление стилей к шапке сайта при скролле
    let coord = $('.header__top').offset().top + $('.header__top').height();

    $(window).scroll(function () {
        if ($(window).scrollTop() < coord) {
            $('.header__top').addClass("header__top--scroll");
            $('.header__top-inner').addClass("header__top-inner--scroll");
        }
    });

    $(window).scroll(function () {
        if ($(window).scrollTop() == 0) {
            $('.header__top').removeClass("header__top--scroll");
            $('.header__top-inner').removeClass("header__top-inner--scroll");
        }
    });

    // Кнопка отзывов при disabled
    $('#send-review_disabled').click(function () {
        $(this).attr('disabled', true);
        $('#review-disabled_text').html('Чтобы оставить коментарий нужно залогиниться.');
    });

   

});


