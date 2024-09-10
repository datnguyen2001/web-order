var swiper = new Swiper(".mySwiper", {
    loop: true,
    spaceBetween: 10,
    slidesPerView: 7,
    freeMode: true,
    watchSlidesProgress: true,
});
var swiper2 = new Swiper(".mySwiper2", {
    loop: true,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    thumbs: {
        swiper: swiper,
    },
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

$('.box-item-color').click(function() {
    $('.box-item-color').removeClass('box-item-color-active');
    $(this).addClass('box-item-color-active');
});

$('.box-attribute .box-item-size').each(function() {
    const $item = $(this);
    const $btnMinus = $item.find('.btn-minus-plus').first();
    const $btnPlus = $item.find('.btn-minus-plus').last();
    const $inputQuantity = $item.find('.input-quntity');

    $btnMinus.click(function() {
        let currentValue = parseInt($inputQuantity.val());
        if (currentValue > 0) {
            $inputQuantity.val(currentValue - 1);
        }
    });

    $btnPlus.click(function() {
        let currentValue = parseInt($inputQuantity.val());
        $inputQuantity.val(currentValue + 1);
    });
});
