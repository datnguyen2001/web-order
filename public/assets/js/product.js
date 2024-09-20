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
    let currentActiveColor = $('.box-item-color-active');
    if (currentActiveColor.length) {
        let quantities = {};
        $('.box-item-size').each(function() {
            let index = $(this).data('index');
            let quantityInput = $(this).find('.input-quntity');
            let currentQuantity = parseInt(quantityInput.val()) || 0;
            quantities[index] = currentQuantity;
        });
        currentActiveColor.data('quantities', quantities);
    }

    // Switch active color
    $('.box-item-color').removeClass('box-item-color-active');
    $(this).addClass('box-item-color-active');

    let valueID = $(this).data('value-id');
    let exchangeRate = $(this).data('exchange-rate');
    let storedQuantities = $(this).data('quantities') || {};

    $.ajax({
        url: `/api/get-attribute/${valueID}`,
        type: 'GET',
        success: function(response) {
            if (response.status !== false) {
                let attributes = response.data;

                $('#box-size').empty();

                attributes.forEach(function(item, index) {
                    let priceVND = parseFloat(item.price * exchangeRate).toFixed(0);
                    let storedQuantity = storedQuantities[index] || 0; // Retrieve stored quantity by index

                    $('#box-size').append(`
                        <div class="box-item-size" data-index="${index}" data-quantity="${storedQuantity}"
                        data-product-name="${item.product_name}" data-value-name="${item.product_value_name}"
                        data-product-image="${item.product_image}" data-product-value-image="${item.product_value_src}"
                        data-attribute-name="${item.name}" data-attribute-chinese-price="${item.price}" data-attribute-vietnamese-price="${priceVND}">
                            <span class="title-size-item">${item.name}</span>
                            <div class="title-price-size">
                                <p class="price_cn">¥${parseFloat(item.price).toFixed(2)}</p>
                                <p class="price_vn">${priceVND}₫</p>
                            </div>
                            <div class="title-note">
                                ${parseInt(item.quantity).toLocaleString('vi-VN')} sản phẩm có sẵn
                            </div>
                            <div class="box-quantity-fa">
                                <button class="btn-minus-plus" data-type="minus"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" class="input-quntity" value="${storedQuantity}" data-index="${index}">
                                <button class="btn-minus-plus" data-type="plus"><i class="fa-solid fa-plus"></i></button>
                            </div>
                        </div>
                    `);
                });

                attachPlusMinusEvents();
            } else {
                alert(response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX error:', error);
        }
    });
});

function saveToLocalStorage(productName, valueName, attributeName, quantity, productImage, productValueImage, chinesePrice, vietnamesePrice) {
    let cartItems = JSON.parse(localStorage.getItem('cart_items')) || [];

    let existingItemIndex = cartItems.findIndex(item =>
        item.product_name === productName &&
        item.value_name === valueName &&
        item.attribute_name === attributeName
    );

    if (existingItemIndex !== -1) {
        cartItems[existingItemIndex].quantity = quantity;
        cartItems[existingItemIndex].chinese_price = chinesePrice;
        cartItems[existingItemIndex].vietnamese_price = vietnamesePrice;
    } else {
        cartItems.push({
            product_name: productName,
            value_name: valueName,
            attribute_name: attributeName,
            quantity: quantity,
            product_image: productImage,
            product_value_image: productValueImage,
            chinese_price: chinesePrice,
            vietnamese_price: vietnamesePrice
        });
    }

    // Save the updated cartItems array back to local storage
    localStorage.setItem('cart_items', JSON.stringify(cartItems));
}

//UPDATE PRODUCT WITH ATTRIBUE
function updateQuantity(parentBox, type) {
    let quantityInput = parentBox.find('.input-quntity');
    let currentQuantity = parseInt(quantityInput.val()) || 0;
    let productName = parentBox.data('product-name');
    let valueName = parentBox.data('value-name');
    let attributeName = parentBox.data('attribute-name');
    let productImage = parentBox.data('product-image');
    let productValueImage = parentBox.data('product-value-image');
    let chinesePrice = parentBox.data('attribute-chinese-price');
    let vietnamesePrice = parentBox.data('attribute-vietnamese-price');

    if (type === 'plus') {
        currentQuantity += 1;
    } else if (type === 'minus' && currentQuantity > 0) {
        currentQuantity -= 1;
    }

    quantityInput.val(currentQuantity);
    parentBox.data('quantity', currentQuantity);

    saveToLocalStorage(productName, valueName, attributeName, currentQuantity, productImage, productValueImage, chinesePrice, vietnamesePrice);

    let totalQuantity = 0;
    $('.input-quntity').each(function() {
        totalQuantity += parseInt($(this).val()) || 0;
    });

    let activeColorBox = $('.box-item-color-active');
    let propItemTotal = activeColorBox.find('.prop-item-total');
    propItemTotal.text('x' + totalQuantity);
    propItemTotal.css('display', 'block');
}
function attachPlusMinusEvents() {
    $('.box-item-size').each(function() {
        const $item = $(this);
        const $btnMinus = $item.find('.btn-minus-plus[data-type="minus"]');
        const $btnPlus = $item.find('.btn-minus-plus[data-type="plus"]');
        const $inputQuantity = $item.find('.input-quntity');

        let storedQuantity = $item.data('quantity') || 0;
        $inputQuantity.val(storedQuantity);

        $btnMinus.off('click').on('click', function() {
            updateQuantity($item, 'minus');
        });

        $btnPlus.off('click').on('click', function() {
            updateQuantity($item, 'plus');
        });
    });
}
attachPlusMinusEvents();

//UPDATE PRODUCT WITH NO ATTRIBUTE
function updateQuantityNoAttribute(parentBox, type) {
    let quantityInput = parentBox.find('.input-quntity');
    let currentQuantity = parseInt(quantityInput.val()) || 0;
    let productName = parentBox.data('product-name');
    let valueName = parentBox.data('value-name');
    let attributeName = parentBox.data('attribute-name');
    let productImage = parentBox.data('product-image');
    let productValueImage = parentBox.data('product-value-image');
    let chinesePrice = parentBox.data('attribute-chinese-price');
    let vietnamesePrice = parentBox.data('attribute-vietnamese-price');

    if (type === 'plus') {
        currentQuantity += 1;
    } else if (type === 'minus' && currentQuantity > 0) {
        currentQuantity -= 1;
    }

    quantityInput.val(currentQuantity);
    parentBox.data('quantity', currentQuantity);

    saveToLocalStorage(productName, valueName, attributeName, currentQuantity, productImage, productValueImage, chinesePrice, vietnamesePrice);
}
function attachPlusMinusEventsNoAttribute() {
    $('#quantity-no-attribute').each(function() {
        const $item = $(this);
        const $btnMinus = $item.find('.btn-minus-plus[data-type="minus"]');
        const $btnPlus = $item.find('.btn-minus-plus[data-type="plus"]');
        const $inputQuantity = $item.find('.input-quntity');

        let storedQuantity = $item.data('quantity') || 0;
        $inputQuantity.val(storedQuantity);

        $btnMinus.off('click').on('click', function() {
            updateQuantityNoAttribute($item, 'minus');
        });

        $btnPlus.off('click').on('click', function() {
            updateQuantityNoAttribute($item, 'plus');
        });
    });
}
attachPlusMinusEventsNoAttribute();

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.btn-add-cart').click(function() {
    let cartItems = JSON.parse(localStorage.getItem('cart_items')) || [];
    if (cartItems.length === 0) {
        alert('Vui lòng chọn sản phẩm.');
        return;
    }

    // Send cart data to the server via AJAX
    $.ajax({
        url: '/add-to-cart',
        type: 'POST',
        data: {
            cartItems: cartItems
        },
        success: function(response) {
            if (response.status) {
                alert(response.message);
                localStorage.removeItem('cart_items');
                window.location.href = cartUrl;
            } else {
                alert('Có lỗi xảy ra: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            if (xhr.status === 401) {
                window.location.href = loginUrl;
            } else {
                console.error('AJAX error:', error);
                alert('Có lỗi xảy ra: ' + error);
            }
        }
    });
});

window.onbeforeunload = function() {
    localStorage.removeItem('cart_items');
};
