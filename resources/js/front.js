require('./bootstrap');

require('./mantener-relacion-alto');

require('sweetalert');

require('lity');

require('./formularios');

$(function() {
    GLightbox({selector: ".glightbox-video",closeOnOutsideClick: true,videosWidth: "90%",skin: 'glightbox-vid glightbox-clean'});

    $('[data-auto-abrir-popup]').each(function() {
        var ancho_minimo = $(this).data('auto-abrir-popup');
        var vw = Math.max(document.documentElement.clientWidth || 0, window.innerWidth || 0);
        if(!ancho_minimo || parseInt(ancho_minimo) <= vw) {
            $(this).click();
            return false;
        }
    });

    $('[data-cerrar-popup]').click(function(e) {
        e.preventDefault();
        $.fancybox.close();
    });

    $('.desplegar-menu-principal').click(function(e) {
        e.preventDefault();
        $(this).siblings('ul').slideToggle('fast');
    });

    
    $('.slides').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 5000,
    });

    $('.galeria .contenidos').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        asNavFor: '.galeria .nav',
        // responsive: [
        //     {
        //         breakpoint: 850,
        //         settings: {
        //             arrows: false,
        //             centerMode: true,
        //         }
        //     },
        // ]
    });
    $('.galeria .nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        arrows: false,
        infinite: true,
        centerMode:true,
        asNavFor: '.galeria .contenidos',
        focusOnSelect: true,
    });

    $('.iconos ul').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    slidesToShow: 5,
                }
            },
            {
                breakpoint: 850,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 650,
                settings: {
                    slidesToShow: 2,
                }
            },
        ]
    });
    
    $('.novedades .listado').slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        autoplay: false,
        responsive: [{
            breakpoint: 1000,
            settings: {
                slidesToShow: 2,
            }
        },{
            breakpoint: 850,
            settings: {
                slidesToShow: 1,
            }
        }]
    });

    document.body.style.setProperty('--header-height', $('body > header').height() + 'px');

});

