$(document).ready(function() {
    // Function to calculate both Chinese and Vietnamese total prices
    function calculateTotalPrice() {
        let totalChinesePrice = 0;
        let totalVietnamesePrice = 0;

        let hasCheckedProduct = false;

        $('.product-checkbox:checked').each(function() {
            // Get the total Chinese and Vietnamese prices for the checked product
            let chinesePrice = parseFloat($(this).data('product-chinese-price')) || 0;
            let vietnamesePrice = parseFloat($(this).data('product-vietnamese-price')) || 0;

            totalChinesePrice += chinesePrice;
            totalVietnamesePrice += vietnamesePrice;

            hasCheckedProduct = true;
        });

        let formattedChinesePrice = Math.floor(totalChinesePrice);
        let formattedVietnamesePrice = Math.floor(totalVietnamesePrice);

        // Format the prices without decimals
        $('#total-price-chinese').text('¥' + new Intl.NumberFormat('vi-VN').format(formattedChinesePrice));
        $('#total-price-vnd').text('(' + new Intl.NumberFormat('vi-VN').format(formattedVietnamesePrice) + '₫)');

        if (hasCheckedProduct) {
            // At least one product is checked, enable the active button
            $('.btn-buy-cart').removeClass('btn-cart-disable').addClass('btn-cart-active');
            $('.btn-buy-cart').prop('disabled', false);
        } else {
            // No product is checked, disable the button
            $('.btn-buy-cart').removeClass('btn-cart-active').addClass('btn-cart-disable');
            $('.btn-buy-cart').prop('disabled', true);
        }
    }

    // "Chọn tất cả" checkbox changed
    $('.select_all').change(function() {
        // Lấy trạng thái của checkbox "Chọn tất cả"
        var isChecked = $(this).is(':checked');

        // Đặt trạng thái cho tất cả các checkbox sản phẩm
        $('.product-checkbox').prop('checked', isChecked);

        // Đặt trạng thái cho tất cả các checkbox shop
        $('.shop-checkbox').prop('checked', isChecked);
        $('.select_all_bottom').prop('checked', isChecked);

        // Recalculate the total price
        calculateTotalPrice();
    });

    $('.select_all_bottom').change(function() {
        // Lấy trạng thái của checkbox "Chọn tất cả"
        var isChecked = $(this).is(':checked');


        // Đặt trạng thái cho tất cả các checkbox sản phẩm
        $('.product-checkbox').prop('checked', isChecked);

        // Đặt trạng thái cho tất cả các checkbox shop
        $('.shop-checkbox').prop('checked', isChecked);
        $('.select_all').prop('checked', isChecked);

        // Recalculate the total price
        calculateTotalPrice();
    });

    // Khi một checkbox sản phẩm thay đổi
    $('.product-checkbox').change(function() {
        // Kiểm tra xem tất cả các checkbox sản phẩm có được chọn không
        var allChecked = $('.product-checkbox').length === $('.product-checkbox:checked').length;

        // Cập nhật trạng thái của checkbox "Chọn tất cả" dựa trên tất cả checkbox sản phẩm
        $('.select_all').prop('checked', allChecked);
        $('.select_all_bottom').prop('checked', allChecked);

        // Recalculate the total price
        calculateTotalPrice();
    });

    // Khi thay đổi trạng thái của bất kỳ checkbox shop nào
    $(document).on('change', '.shop-checkbox', function() {
        var allChecked = $('.shop-checkbox').length === $('.shop-checkbox:checked').length;

        // Cập nhật trạng thái của checkbox "Chọn tất cả" dựa trên trạng thái của các checkbox shop
        $('#total_sp_all').prop('checked', allChecked);
    });

    calculateTotalPrice();

    // Thêm địa chỉ
    $('#province').on('change', function () {
        var provinceId = $(this).val();
        $('#district').html('<option value="">Chọn quận/huyện</option>');
        $('#ward').html('<option value="">Chọn phường/xã</option>');

        if (provinceId) {
            $.ajax({
                url: 'get-district/'+provinceId,
                type: 'GET',
                success: function (data) {
                    if (data.status){
                        var districtOptions = '<option value="">Chọn quận/huyện</option>';
                        $.each(data.data, function (key, district) {
                            districtOptions += '<option value="' + district.district_id + '">' + district.name + '</option>';
                        });
                        $('#district').html(districtOptions);
                    }else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $('#district').on('change', function () {
        var districtId = $(this).val();

        $('#ward').html('<option value="">Chọn phường/xã</option>');

        if (districtId) {
            $.ajax({
                url: 'get-wards/'+districtId,
                type: 'GET',
                success: function (data) {
                    if (data.status) {
                        var wardOptions = '<option value="">Chọn phường/xã</option>';
                        $.each(data.data, function (key, ward) {
                            wardOptions += '<option value="' + ward.wards_id + '">' + ward.name + '</option>';
                        });
                        $('#ward').html(wardOptions);
                    }else {
                        toastr.error(data.message);
                    }
                }
            });
        }
    });

    $('#address-form').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: 'save-address',
            type: 'POST',
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.status){
                    $('#address-form')[0].reset();
                    window.location.href = confirmApplicationURL;
                }else {
                    toastr.error(response.message);
                }

            }
        });
    });

});

//Delete attribute
$(document).on('click', '.icon-item-delete-attribute', function() {
    var productName = $(this).data('product-name');
    var productValue = $(this).data('value-name');
    var productAttribute = $(this).data('attribute-name');

    $.ajax({
        url: deleteAttributeURL,
        type: 'POST',
        data: {
            _token: csrfToken,
            product_name: productName,
            product_value: productValue,
            product_attribute: productAttribute
        },
        success: function(response) {
            alert('Xoá sản phẩm thành công');
            location.reload();

        },
        error: function(xhr) {
            alert('Error deleting attribute from the cart');
        }
    });
});

//Delete product
$(document).on('click', '.btn-delete-cart-shop', function() {
    var productName = $(this).data('product-name');

    $.ajax({
        url: deleteProductURL,
        type: 'POST',
        data: {
            _token: csrfToken,
            product_name: productName
        },
        success: function(response) {
            alert('Xoá sản phẩm thành công');
            location.reload();
        },
        error: function(xhr) {
            alert('Error deleting the product from the cart');
        }
    });
});

//Delete all cart
$(document).on('click', '.btn-delete-all-cart', function() {
    var userId = $(this).data('user-id');

    $.ajax({
        url: deleteCartURL,
        type: 'POST',
        data: {
            _token: csrfToken,
            user_id: userId
        },
        success: function(response) {
            alert('Xoá sản phẩm thành công');
            location.reload();
        },
        error: function(xhr) {
            alert('Error deleting the cart');
        }
    });
});

//Check cart address and move to confirm route
$('.btn-buy-cart').on('click', function(event) {
    event.preventDefault();

    let selectedProductIds = [];

    // Collect selected product IDs
    $('.product-checkbox:checked').each(function() {
        let productId = $(this).data('product-id');

        if (typeof productId === 'string' && productId.includes(',')) {
            let multipleIds = productId.split(',');
            selectedProductIds = selectedProductIds.concat(multipleIds.map(id => parseInt(id))); // Convert to integer
        } else {
            selectedProductIds.push(parseInt(productId));
        }
    });

    $.ajax({
        url: '/check-address',
        type: 'GET',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {
            if (data.address_exists) {
                $.ajax({
                    url: updateStatus,
                    type: 'POST',
                    data: {
                        product_ids: selectedProductIds
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function() {
                        window.location.href = confirmApplicationURL;
                    }
                });
            } else {
                // If address doesn't exist, show the modal
                $('#staticBackdropAddress').modal('show');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
        }
    });
});


