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
    let district_id;
    let ward_id;
    $('.update-link').on('click', function() {
        var id = $(this).data('id');
        var provinceId = $(this).data('province');
        var districtId = $(this).data('district');
        var wardId = $(this).data('ward');
        district_id = districtId;
        ward_id = wardId;

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
                    provinceSelect.append('<option value="' + province.province_id + '" ' + province_selected + '>' + province.name + '</option>');
                });

                districtSelect.empty().append('<option value="">Chọn quận/huyện</option>');
                $.each(response.districts, function(index, district) {
                    var district_selected = districtId == district.district_id ? 'selected' : '';
                    districtSelect.append('<option value="' + district.district_id + '" ' + district_selected + '>' + district.name + '</option>');
                });

                wardSelect.empty().append('<option value="">Chọn phường/xã</option>');
                $.each(response.wards, function(index, ward) {
                    var ward_selected = wardId == ward.wards_id ? 'selected' : '';
                    wardSelect.append('<option value="' + ward.wards_id + '" ' + ward_selected + '>' + ward.name + '</option>');
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

    $('#provinceUpdate').on('change', function () {
        var provinceId = $(this).val();
        var districtSelect = $('#staticUpdateAddress').find('select[name="district_id"]');
        var wardSelect = $('#staticUpdateAddress').find('select[name="ward_id"]');

        $.ajax({
            url: '/get-district/'+provinceId,
            method: 'GET',
            success: function(response) {
                if (response.status) {
                    districtSelect.empty().append('<option value="">Chọn quận/huyện</option>');
                    $.each(response.data, function (index, district) {
                        var districted = district_id == district.district_id ? 'selected' : '';
                        districtSelect.append('<option value="' + district.district_id + '"' + districted + '>' + district.name + '</option>');
                    });

                    wardSelect.empty().append('<option value="">Chọn phường/xã</option>');
                }else {
                    toastr.error(data.message);
                }
            }

        });
    });

    $('#districtUpdate').on('change', function () {
        var districtId = $(this).val();
        var wardSelect = $('#staticUpdateAddress').find('select[name="ward_id"]');

        $.ajax({
            url: '/get-wards/'+districtId,
            method: 'GET',
            success: function(response) {
                if (response.status) {
                    wardSelect.empty().append('<option value="">Chọn phường/xã</option>');
                    $.each(response.data, function(index, ward) {
                        var wards = ward_id == ward.wards_id ? 'selected' : '';
                        wardSelect.append('<option value="' + ward.wards_id + '"' + wards + '>' + ward.name + '</option>');
                    });
                }else {
                    toastr.error(data.message);
                }
            }

        });
    });

});

$('.btn-currency').on('click', function() {
    $('.btn-currency').removeClass('btn-money-active');
    $(this).addClass('btn-money-active');
    if ($(this).hasClass('btn-money-vn')) {
        $('#payment_currency').val(1);
    } else if ($(this).hasClass('btn-money-tq')) {
        $('#payment_currency').val(2);
    }
});

//Deposit percentage
$('input[name="deposit"]').attr('required', true);
$('#fee-45').hide();
$('#fee-70').hide();
$('input[name="deposit"]').on('change', function() {
    var depositValue = $(this).val();

    if (depositValue === '45') {
        $('#fee-45').show();
        $('#fee-70').hide();
        $('#deposit_money').val((totalChinesePriceAllProducts * 0.45).toFixed(2));
        $('#deposit_money_cn').text('¥' + (totalChinesePriceAllProducts * 0.45).toFixed(2).replace('.', ','));
        $('#deposit_money_vn').text((Math.round(totalChinesePriceAllProducts * 0.45 * exchangeRate)).toLocaleString('vi-VN') + '₫');
        $('.partial_payment_fee_chinese').val(totalDepositPrice45CN);
        $('.partial_payment_fee_vietnamese').val(totalDepositPrice45CN * exchangeRate);
        $('.partial_payment_fee_display').text('¥' + totalDepositPrice45CN.toFixed(2).replace('.', ','));
    } else if (depositValue === '70') {
        $('#fee-45').hide();
        $('#fee-70').show();
        $('#deposit_money').val((totalChinesePriceAllProducts * 0.70).toFixed(2));
        $('#deposit_money_cn').text('¥' + (totalChinesePriceAllProducts * 0.70).toFixed(2).replace('.', ','));
        $('#deposit_money_vn').text((Math.round(totalChinesePriceAllProducts * 0.70 * exchangeRate)).toLocaleString('vi-VN') + '₫');
        $('.partial_payment_fee_chinese').val(totalDepositPrice70CN);
        $('.partial_payment_fee_vietnamese').val(totalDepositPrice70CN * exchangeRate);
        $('.partial_payment_fee_display').text('¥' + totalDepositPrice70CN.toFixed(2).replace('.', ','));
    } else if (depositValue === '100') {
        $('#fee-45').hide();
        $('#fee-70').hide();
        $('#deposit_money').val(totalChinesePriceAllProducts.toFixed(2));
        $('#deposit_money_cn').text('¥' + (totalChinesePriceAllProducts).toFixed(2).replace('.', ','));
        $('#deposit_money_vn').text((Math.round(totalChinesePriceAllProducts * exchangeRate)).toLocaleString('vi-VN') + '₫');
        $('.partial_payment_fee_chinese').val(0);
        $('.partial_payment_fee_vietnamese').val(0);
        $('.partial_payment_fee_display').text('¥0,00');
    }
    $('.partial_payment_fee_chinese').trigger('change');
    $('.partial_payment_fee_vietnamese').trigger('change');
});

//Update tally value
function calculateTallyValue() {
    var isChecked = $('#is-tally-checkbox').is(':checked');
    var tallyValue = 0;
    var tallyValueVietnamese = 0
    if (isChecked) {
        tallyValue = totalChinesePriceAllProducts * tallySettingRate;
        tallyValueVietnamese = totalChinesePriceAllProducts * tallySettingRate * exchangeRate;
    }

    $('input[name="tally_fee_chinese"]').val(tallyValue.toFixed(2));
    $('input[name="tally_fee_vietnamese"]').val(tallyValueVietnamese.toFixed(2));
    $('.tally_fee_display').text('¥' + tallyValue.toFixed(2).replace('.', ','));

    return tallyValue;
}
// Function to calculate total cost of commodity
function calculateTotalCommodityCost() {
    var goodsMoney = parseFloat($('input[name="goods_money_chinese"]').val()) || 0;
    var chinaShippingFee = parseFloat($('input[name="china_domestic_shipping_fee_chinese"]').val()) || 0;
    var discount = parseFloat($('input[name="discount_chinese"]').val()) || 0;
    var totalChineseYuan = goodsMoney + chinaShippingFee - discount;
    var totalVietnameseDong = Math.round(totalChineseYuan * exchangeRate);

    // Update the display
    $('#commodity-cost-cn').text('¥' + totalChineseYuan.toFixed(2).replace('.', ','));
    $('#commodity-cost-vn').text(totalVietnameseDong.toLocaleString('vi-VN') + '₫');
}

// Function to calculate import total
function calculateImportTotal() {
    var internationalShippingFee = parseFloat($('input[name="international_shipping_fee_chinese"]').val()) || 0;
    var vietnamDomesticShippingFee = parseFloat($('input[name="vietnam_domestic_shipping_fee_chinese"]').val()) || 0;
    var insuranceFee = parseFloat($('input[name="insurance_fee_chinese"]').val()) || 0;
    var partialPaymentFee = parseFloat($('.partial_payment_fee_chinese').val()) || 0;
    var tallyFee = parseFloat($('input[name="tally_fee_chinese"]').val()) || 0;
    var totalChineseYuan = internationalShippingFee + vietnamDomesticShippingFee + insuranceFee + partialPaymentFee + tallyFee;
    var totalVietnameseDong = Math.round(totalChineseYuan * exchangeRate);

    // Update the display
    $('#import-cost-cn').text('¥' + totalChineseYuan.toFixed(2).replace('.', ','));
    $('#import-cost-vn').text(totalVietnameseDong.toLocaleString('vi-VN') + '₫');
}
function calculateTotalPayment() {
    var importCostCN = parseFloat($('#import-cost-cn').text().replace('¥', '').replace(',', '.')) || 0;
    var commodityCostCN = parseFloat($('#commodity-cost-cn').text().replace('¥', '').replace(',', '.')) || 0;
    var totalChineseYuan = importCostCN + commodityCostCN;
    var totalVietnameseDong = Math.round(totalChineseYuan * exchangeRate);

    $('#total-fee-chinese').text('¥' + totalChineseYuan.toFixed(2).replace('.', ','));
    $('#total-fee-vietnamese').text(totalVietnameseDong.toLocaleString('vi-VN') + '₫');
    $('input[name="total_payment_chinese"]').val(totalChineseYuan.toFixed(2));
    $('input[name="total_payment_vietnamese"]').val(totalVietnameseDong);
}
function updateAllTotals() {
    calculateTallyValue();
    calculateTotalCommodityCost();
    calculateImportTotal();
    calculateTotalPayment();
}
$(document).ready(function() {
    updateAllTotals();
    $('input[name="international_shipping_fee_chinese"], input[name="vietnam_domestic_shipping_fee_chinese"], input[name="insurance_fee_chinese"], input[name="goods_money_chinese"], input[name="china_domestic_shipping_fee_chinese"], input[name="discount_chinese"], .partial_payment_fee_chinese').on('change', updateAllTotals);
    $('#is-tally-checkbox').on('change', updateAllTotals);
});
