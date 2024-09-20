function selectAddress(element) {
    document.querySelectorAll('.address-card').forEach(card => {
        card.classList.remove('selected');
        card.querySelector('.radio-btn').classList.remove('selected');
    });
    element.classList.add('selected');
    element.querySelector('.radio-btn').classList.add('selected');
}

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

function submitSelectedAddress() {
    var selectedAddressId = $('.address-card.selected').data('id');

    $.ajax({
        url: '/update-default-address',
        method: 'POST',
        data: {
            id: selectedAddressId
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.status) {
                window.location.reload();
            } else {
                toastr.error('Cập nhật địa chỉ mặc định không thành công.');
            }
        }
    });
}

$(document).ready(function() {
    $('.update-link').on('click', function() {
        var id = $(this).data('id');
        var provinceId = $(this).data('province');
        var districtId = $(this).data('district');
        var wardId = $(this).data('ward');

        $.ajax({
            url: '/edit-address',
            method: 'GET',
            data: { province_id: provinceId,district_id: districtId },
            success: function(response) {
                var provinceSelect = $('#staticUpdateAddress').find('select[name="province_id"]');
                var districtSelect = $('#staticUpdateAddress').find('select[name="district_id"]');
                var wardSelect = $('#staticUpdateAddress').find('select[name="ward_id"]');

                provinceSelect.empty().append('<option value="">Chọn tỉnh/thành phố</option>');
                $.each(response.provinces, function(index, province) {
                    var province_selected = provinceId == province.id ? 'selected' : '';
                    provinceSelect.append('<option value="' + province.id + '" ' + province_selected + '>' + province.name + '</option>');
                });

                districtSelect.empty().append('<option value="">Chọn quận/huyện</option>');
                $.each(response.districts, function(index, district) {
                    var district_selected = districtId == district.id ? 'selected' : '';
                    districtSelect.append('<option value="' + district.id + '" ' + district_selected + '>' + district.name + '</option>');
                });

                wardSelect.empty().append('<option value="">Chọn phường/xã</option>');
                $.each(response.wards, function(index, ward) {
                    var ward_selected = wardId == ward.id ? 'selected' : '';
                    wardSelect.append('<option value="' + ward.id + '" ' + ward_selected + '>' + ward.name + '</option>');
                });

                $('#staticUpdateAddress').find('input[name="name"]').val($(this).data('name'));
                $('#staticUpdateAddress').find('input[name="phone"]').val($(this).data('phone'));
                $('#staticUpdateAddress').find('input[name="detail_address"]').val($(this).data('detail'));
                provinceSelect.val(provinceId).change();
                districtSelect.val(districtId).change();
                wardSelect.val(wardId);
                $('#staticUpdateAddress').find('input[type="checkbox"]').prop('checked', $(this).data('is_default') == 1);
                $('#address-id').val(id);
            }.bind(this)
        });
    });


    $('#staticUpdateAddress').find('select[name="province"]').on('change', function() {
        var provinceId = $(this).val();
        var districtSelect = $('#staticUpdateAddress').find('select[name="district"]');
        var wardSelect = $('#staticUpdateAddress').find('select[name="ward"]');

        $.ajax({
            url: '/get-district',
            method: 'GET',
            data: { province_id: provinceId },
            success: function(response) {
                districtSelect.empty().append('<option value="">Chọn quận/huyện</option>');
                $.each(response.districts, function(index, district) {
                    districtSelect.append('<option value="' + district.id + '">' + district.name + '</option>');
                });

                wardSelect.empty().append('<option value="">Chọn phường/xã</option>');
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi lấy dữ liệu quận/huyện.');
            }
        });
    });

    $('#staticUpdateAddress').find('select[name="district"]').on('change', function() {
        var districtId = $(this).val();
        var wardSelect = $('#staticUpdateAddress').find('select[name="ward"]');

        $.ajax({
            url: '/get-wards',
            method: 'GET',
            data: { district_id: districtId },
            success: function(response) {
                wardSelect.empty().append('<option value="">Chọn phường/xã</option>');
                $.each(response.wards, function(index, ward) {
                    wardSelect.append('<option value="' + ward.id + '">' + ward.name + '</option>');
                });
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Có lỗi xảy ra khi lấy dữ liệu phường/xã.');
            }
        });
    });
});

function updateAddress() {
    var id = $('#address-id').val();
    var name = $('#staticUpdateAddress').find('input[name="name"]').val();
    var phone = $('#staticUpdateAddress').find('input[name="phone"]').val();
    var provinceId = $('#staticUpdateAddress').find('select[name="province_id"]').val();
    var districtId = $('#staticUpdateAddress').find('select[name="district_id"]').val();
    var wardId = $('#staticUpdateAddress').find('select[name="ward_id"]').val();
    var detailAddress = $('#staticUpdateAddress').find('input[name="detail_address"]').val();
    var isDefault = $('#staticUpdateAddress').find('input[type="checkbox"]').is(':checked') ? 1 : 0;

    $.ajax({
        url: '/update-address/' + id,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            name: name,
            phone: phone,
            province_id: provinceId,
            district_id: districtId,
            ward_id: wardId,
            detail_address: detailAddress,
            is_default: isDefault
        },
        success: function(response) {
            if (response.success) {
                alert('Cập nhật địa chỉ thành công!');
                location.reload();
            } else {
                alert('Có lỗi xảy ra khi cập nhật địa chỉ.');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error);
            alert('Có lỗi xảy ra khi cập nhật địa chỉ.');
        }
    });
}
