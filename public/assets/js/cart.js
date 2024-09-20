$(document).ready(function() {
    // Sự kiện tăng số lượng sản phẩm
    $('.btn-plus').click(function() {
        let quantityInput = $(this).siblings('.input-quantity');
        let currentValue = parseInt(quantityInput.val());
        quantityInput.val(currentValue + 1);

        updateTotalPrice();
    });

    // Sự kiện giảm số lượng sản phẩm
    $('.btn-minus').click(function() {
        let quantityInput = $(this).siblings('.input-quantity');
        let currentValue = parseInt(quantityInput.val());

        if (currentValue > 1) {
            quantityInput.val(currentValue - 1);
        }

        // Cập nhật giá trị tổng giá
        updateTotalPrice();
    });

    // Khi checkbox "Chọn tất cả" được thay đổi
    $('.select_all').change(function() {
        // Lấy trạng thái của checkbox "Chọn tất cả"
        var isChecked = $(this).is(':checked');


        // Đặt trạng thái cho tất cả các checkbox sản phẩm
        $('.product-checkbox').prop('checked', isChecked);

        // Đặt trạng thái cho tất cả các checkbox shop
        $('.shop-checkbox').prop('checked', isChecked);
        $('.select_all_bottom').prop('checked', isChecked);
    });

    $('.select_all_bottom').change(function() {
        // Lấy trạng thái của checkbox "Chọn tất cả"
        var isChecked = $(this).is(':checked');


        // Đặt trạng thái cho tất cả các checkbox sản phẩm
        $('.product-checkbox').prop('checked', isChecked);

        // Đặt trạng thái cho tất cả các checkbox shop
        $('.shop-checkbox').prop('checked', isChecked);
        $('.select_all').prop('checked', isChecked);
    });

    // Khi một checkbox sản phẩm thay đổi
    $('.product-checkbox').change(function() {
        // Kiểm tra xem tất cả các checkbox sản phẩm có được chọn không
        var allChecked = $('.product-checkbox').length === $('.product-checkbox:checked').length;

        // Cập nhật trạng thái của checkbox "Chọn tất cả" dựa trên tất cả checkbox sản phẩm
        $('.select_all').prop('checked', allChecked);
        $('.select_all_bottom').prop('checked', allChecked);
    });

    // Khi một checkbox shop thay đổi
    $('.shop-checkbox').change(function() {
        // Kiểm tra xem tất cả các checkbox shop có được chọn không
        var allShopChecked = $('.shop-checkbox').length === $('.shop-checkbox:checked').length;

        // Cập nhật trạng thái của checkbox "Chọn tất cả" dựa trên tất cả checkbox shop
        $('.select_all').prop('checked', allShopChecked);
        $('.select_all_bottom').prop('checked', allShopChecked);
    });

    // Khi thay đổi trạng thái của checkbox "Chọn tất cả"
    $('.shop-checkbox').change(function() {
        // Lấy trạng thái của checkbox "Chọn tất cả"
        var isChecked = $(this).is(':checked');

        // Đặt trạng thái cho tất cả các checkbox sản phẩm
        $('.product-checkbox').prop('checked', isChecked);

        // Đặt trạng thái cho tất cả các checkbox shop
        $('.shop-checkbox').prop('checked', isChecked);
    });

    // Khi thay đổi trạng thái của bất kỳ checkbox sản phẩm nào
    $(document).on('change', '.product-checkbox', function() {
        // Kiểm tra xem tất cả checkbox sản phẩm có được chọn không
        var allChecked = $('.product-checkbox').length === $('.product-checkbox:checked').length;

    });

    // Khi thay đổi trạng thái của bất kỳ checkbox shop nào
    $(document).on('change', '.shop-checkbox', function() {
        // Kiểm tra xem tất cả checkbox shop có được chọn không
        var allChecked = $('.shop-checkbox').length === $('.shop-checkbox:checked').length;

        // Cập nhật trạng thái của checkbox "Chọn tất cả" dựa trên trạng thái của các checkbox shop
        $('#total_sp_all').prop('checked', allChecked);
    });

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
                    window.location.href = '/xac-nhan-don';
                }else {
                    toastr.error(response.message);
                }

            }
        });
    });

});
