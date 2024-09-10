var swiper = new Swiper(".bannerSwiper", {
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
});

var distributorSwiper = new Swiper(".distributorSwiper", {
    autoplay: {
        delay: 2500,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        1200: {
            slidesPerView: 4,
            spaceBetween: 30,
        },
        768: {
            slidesPerView: 5,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        }
    }
});

var productSwiper = new Swiper(".productSwiper", {
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        1200: {
            slidesPerView: 6,
            spaceBetween: 15,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        }
    }
});

var productShopSwiper = new Swiper(".productShopSwiper", {
    autoplay: {
        delay: 3000,
        disableOnInteraction: false,
    },
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        1200: {
            slidesPerView: 6,
            spaceBetween: 50,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        320: {
            slidesPerView: 2,
            spaceBetween: 10,
        }
    }
});

$(document).ready(function () {
    $('.tab-menu-category').click(function () {
        $('.tab-menu-category').removeClass('active');
        $(this).addClass('active');
        var index = $(this).data('index');

        $('.box-tab-menu-product').hide();
        $('.box-slide-product[data-index="' + index + '"]').show();
    });

    $('.tab-menu-category').first().addClass('active');
    $('.box-tab-menu-product').hide().first().show();

});
