@extends('web.index')
@section('title','Thanh toán')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/pay.css')}}">
    <style>
        .main {
            min-height: 100vh;
            height: 100%;
            background: white;
            padding-bottom: 20px;
        }
        @media (max-width: 1200px) {
            .main {
                padding-bottom: 85px;
            }
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">
        <img src="https://sabomall.com/banner/partner-importing.png" class="img-banner-pay">

        <div class="content-payment">
            <div class="content-item-pay-left">
                <a href="#" class="btn-back-cart"><i class="fa-solid fa-arrow-left"></i> Quay lại giỏ hàng SaboMall</a>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <p class="title-header-payment">Tổng cộng <span>{{count($payments)}}</span> đơn hàng</p>
                    <p class="title-header-payment">*Tiền vốn bao gồm (tiền hàng + phí vận chuyển nội địa TQ)</p>
                </div>
                @php
                    $totalMoneyVietnamese = 0;
                    $totalDepositVietnamese = 0;
                    $totalMoneyChinese = 0;
                    $totalDepositChinese = 0;
                @endphp

                @foreach($payments as $payment)
                    <div class="item-sp-payment">
                        <div class="d-flex align-items-center">
                            <img src="{{ $payment->product_image }}" class="img-sp-payment">
                            <div class="d-flex flex-column gap-2">
                                <div class="name-col-sp">Đơn hàng: <span>{{$payment->order_code ?? ''}}</span></div>
                                <div class="name-col-sp">Số lượng: <span>{{$payment->total_quantity ?? 0 }} sản phẩm</span></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end flex-column gap-2">
                            @if($payment->payment_currency == 1)
                                @php
                                    $totalMoneyVietnamese += $payment->total_payment_vietnamese;
                                    $totalDepositVietnamese += $payment->deposit_money;
                                @endphp
                                <div class="name-col-money">Tổng Chi Phí:
                                    <span>{{ number_format($payment->total_payment_vietnamese, 0, ',', '.') }}₫</span>
                                </div>
                                <div class="name-col-money">Đặt cọc:
                                    <span>{{ number_format($payment->deposit_money * $setting->exchange_rate, 0, ',', '.') }}₫</span>
                                </div>
                            @elseif($payment->payment_currency == 2)
                                @php
                                    $totalMoneyChinese += $payment->total_payment_chinese;
                                    $totalDepositChinese += $payment->deposit_money;
                                @endphp
                                <div class="name-col-money">Tổng Chi Phí:
                                    <span>¥{{ number_format($payment->total_payment_chinese, 2, ',', '.') }}</span>
                                </div>
                                <div class="name-col-money">Đặt cọc:
                                    <span>¥{{ number_format($payment->deposit_money, 2, ',', '.') }}</span>
                                </div>
                            @endif
                        </div>
                        <input type="hidden" class="product-names" value='@json($payment->product_names)'>
                        <input type="hidden" class="payment_currency" value='{{$payment->payment_currency}}'>
                        <input type="hidden" class="order_id" value='{{$payment->id}}'>
                        <input type="hidden" class="address_id" value="{{$payment->address_id}}">
                        <input type="hidden" class="user_buying_id" value="{{$payment->user_id}}">
                    </div>

                @if($payment->payment_currency == 1)
                    <div class="line-money-payment">
                        <div class="title-total-payment">Tổng cộng tiền vốn (VND):</div>
                        <div class="name-total-money-payment">{{ number_format($totalMoneyVietnamese, 0, ',', '.') }}₫</div>
                    </div>
                    <div class="line-money-payment" style="margin-top: 13px">
                        <div class="title-total-payment-big">CẦN ĐẶT CỌC TRƯỚC (VND):</div>
                        <div class="name-total-money-payment-big">{{ number_format($totalDepositVietnamese, 0, ',', '.') }}₫</div>
                    </div>
                @elseif($payment->payment_currency == 2)
                    <div class="line-money-payment">
                        <div class="title-total-payment">Tổng cộng tiền vốn (CNY):</div>
                        <div class="name-total-money-payment">¥{{ number_format($totalMoneyChinese, 2, ',', '.') }}</div>
                    </div>
                    <div class="line-money-payment" style="margin-top: 13px">
                        <div class="title-total-payment-big">CẦN ĐẶT CỌC TRƯỚC (CNY):</div>
                        <div class="name-total-money-payment-big">¥{{ number_format($totalDepositChinese, 2, ',', '.') }}</div>
                    </div>
                @endif
            </div>
            <div class="content-item-pay-right custom-shadow">
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap">
                    <div class="title-payment-method">Phương Thức Thanh Toán</div>
                    <div class="name-payment-method">Tiền tệ thanh toán:
                        <span class="face-value">{{$payment->payment_currency == 1 ? 'đ' : '¥'}}</span>
                        <span class="name-dv">{{$payment->payment_currency == 1 ? 'VNĐ' : 'CNY'}}</span>
                    </div>
                </div>

                <div class="payment-method-container">
                    <div class="payment-method" data-method="prepaid" onclick="selectPaymentMethod(this)">
                        <img src="{{asset('assets/images/icon-payment-method-prepaid.png')}}" alt="Wallet" class="payment-method-icon">
                        <div class="payment-method-info">
                            <strong>Tài khoản trả trước</strong>
                            @if($payment->payment_currency == 1)
                                <small>Số dư: {{ number_format($currentWalletMoney->vietnamese_money, 0, ',', '.') }}₫ </small>
                            @elseif($payment->payment_currency == 2)
                                <small>Số dư: ¥{{ number_format($currentWalletMoney->middle_money, 2, ',', '.') }} </small>
                            @endif
                        </div>
                        <span class="checkmark"></span>
                    </div>
                    @if($payment->payment_currency == 1)
                        <div class="payment-method" data-method="bank" onclick="selectPaymentMethod(this)">
                            <i class="fa-solid fa-qrcode"></i>
                            <div class="payment-method-info">
                                <strong>Chuyển khoản ngân hàng</strong>
                            </div>
                            <span class="checkmark"></span>
                        </div>
                    @endif
                </div>
                @endforeach
                <div class="name-note-payment">Bằng việc đặt hàng, bạn đồng ý rằng đơn hàng được uỷ thác, vận chuyển thông qua 1688 Global và đồng ý với điều khoản dịch vụ của 1688 Global và SaboMall
                </div>
                <button class="btn-payment-now" onclick="handlePayment()">Thanh Toán</button>
            </div>
        </div>

    </div>

    {{--    Modal trả trước--}}
    <div class="modal fade" id="modalPrepaid" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalPrepaidLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                @if($payment->payment_currency == 1)
                    @if($totalDepositVietnamese > $currentWalletMoney->vietnamese_money)
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <div class="box-img-qr">
                                    <img src="{{asset('assets/images/icon-sbpay-pw-unset.svg')}}" class="icon-qr-bank">
                                </div>
                            </div>
                            <div class="name-money-bank">
                                Số dư trong ví của bạn không đủ. </br>
                                Vui lòng cập nhật ngay để tiếp tục
                            </div>
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <a href="{{route('wallet', ['vi'])}}" class="btn btn-transferred-money">Cập nhật ngay</a>
                        </div>
                    @else
                        <div class="modal-body mt-5">
                            <div class="d-flex justify-content-center">
                                <div class="box-img-qr">
                                    <img src="{{asset('assets/images/success.svg')}}" class="icon-qr-bank">
                                </div>
                            </div>
                            <div class="name-money-bank mt-3">
                                <h3 class="mb-0">Thanh toán thành công</h3>
                            </div>
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <a href="{{route('home')}}" class="btn btn-transferred-money">Xác nhận</a>
                        </div>
                    @endif
                @elseif($payment->payment_currency == 2)
                    @if($totalDepositChinese > $currentWalletMoney->middle_money)
                        <div class="modal-header border-0">
                            <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="d-flex justify-content-center">
                                <div class="box-img-qr">
                                    <img src="{{asset('assets/images/icon-sbpay-pw-unset.svg')}}" class="icon-qr-bank">
                                </div>
                            </div>
                            <div class="name-money-bank">
                                Số dư trong ví của bạn không đủ. </br>
                                Vui lòng cập nhật ngay để tiếp tục
                            </div>
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <a href="{{route('wallet', ['vi'])}}" class="btn btn-transferred-money">Cập nhật ngay</a>
                        </div>
                    @else
                        <div class="modal-body mt-5">
                            <div class="d-flex justify-content-center">
                                <div class="box-img-qr">
                                    <img src="{{asset('assets/images/success.svg')}}" class="icon-qr-bank">
                                </div>
                            </div>
                            <div class="name-money-bank mt-3">
                                <h3 class="mb-0">Thanh toán thành công</h3>
                            </div>
                        </div>
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <a href="{{route('home')}}" class="btn btn-transferred-money">Xác nhận</a>
                        </div>
                    @endif
                @endif

            </div>
        </div>
    </div>
    <!-- Modal chuyển khoản -->
    <div class="modal fade" id="modalBankTransfer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalBankTransferLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address text-center w-100" id="switchBanksLable">Quét mã QR để thanh toán</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-center">
                        <div class="box-img-qr">
                            <img src="https://img.vietqr.io/image/bidv-8850377934-compact2.jpg?amount=100000&addInfo=CK%20ZGZ6C1YGQYQWT" class="icon-qr-bank">
                        </div>
                    </div>
                    <div class="name-money-bank">Thanh toán trước: <span>{{ number_format($totalDepositVietnamese, 0, ',', '.') }}₫</span></div>
                    <p class="note-banking">Vui lòng chỉ thanh toán qua hệ thống SaboMall để đảm bảo an toàn</p>
                    <div class="note-money-banking">
                        <i class="fa-solid fa-circle-info"></i>
                        <div class="name-note-banking">
                            Lưu ý: Giao dịch chuyển khoản dưới <span>100.000đ</span> có thể mất nhiều thời gian để được xác nhận do thông báo từ Ngân hàng. Số tiền thanh toán thừa sẽ được cộng vào tài khoản trả trước của bạn để thanh toán các lần tiếp theo.
                        </div>
                    </div>
                    <div class="line-info-banking">
                        Số tiền: <input type="text" class="input-money-banking" id="amountInput" value="{{ number_format($totalDepositVietnamese, 0, ',', '.') }}" readonly>
                        <button class="btn-copy" onclick="copyToClipboard('amountInput')"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    <div class="line-info-banking">
                        Ngân hàng: <span id="bankName">Ngân hàng TMCP Đầu tư và Phát triển Việt Nam</span>
                        <button class="btn-copy" onclick="copyToClipboardText('bankName')"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    <div class="line-info-banking">
                        Số tài khoản: <span id="accountNumber">8850377934</span>
                        <button class="btn-copy" onclick="copyToClipboardText('accountNumber')"><i class="fa-regular fa-copy"></i></button>
                    </div>
                    <div class="line-info-banking">
                        Nội dung: <span id="transferNote">CK ZGZ6C1YGQYQWT</span>
                        <button class="btn-copy" onclick="copyToClipboardText('transferNote')"><i class="fa-regular fa-copy"></i></button>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-transferred-money" id="done-bank-transfer">Tôi Đã Chuyển Khoản</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal banking complete-->
    <div class="modal fade" id="bankComplete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="bankCompleteLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 525px">
            <div class="modal-content" >
                <div class="modal-body d-flex flex-column align-items-center">
                    <img src="{{asset('assets/images/deposit-waiting.svg')}}" class="icon-complete-banking">
                    <p class="title-banking-complete">Giao dịch đang được xử lý</p>
                    <p class="name-banking-complete">Việc chuyển khoản có thể mất một thời gian ngắn để được xác nhận và xử lý </p>
                </div>
                <div class="modal-footer border-0 pt-0 d-flex justify-content-center align-items-center gap-2">
                    <a href="{{route('order')}}" class="btn btn-management">Quản Lý Đơn</a>
                    <a href="{{route('home')}}" class="btn btn-shopping">Tiếp Tục Mua Hàng</a>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script_page')
    <script>
        let selectedPaymentMethod = null;
        var paymentCurrency = $('.payment_currency').val();
        var orderID = $('.order_id').val();
        var addressID = $('.address_id').val();
        var userBuyingID = $('.user_buying_id').val();

        function selectPaymentMethod(element) {
            document.querySelectorAll('.payment-method').forEach(method => {
                method.classList.remove('selected');
                method.querySelector('.checkmark').classList.remove('selected');
            });
            element.classList.add('selected');
            element.querySelector('.checkmark').classList.add('selected');
            selectedPaymentMethod = element.getAttribute('data-method');
        }

        function handlePayment() {

            if (selectedPaymentMethod === 'prepaid') {
                var productNames = [];
                $('.product-names').each(function() {
                    productNames.push($(this).val());
                });
                $.ajax({
                    url: '{{ url("status-order-wallet") }}/' + orderID + '/2',
                    method: 'GET',
                    success: function(response) {
                        if (response.status) {
                            console.log(response);
                            proccessChangeWalletBalance();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
                function proccessChangeWalletBalance(){
                    if(paymentCurrency === '1'){
                        var totalMoneyDepositVN = parseInt({{$totalDepositVietnamese}}, 10);
                        var walletMoneyVN = parseInt({{$currentWalletMoney->vietnamese_money}}, 10);

                        if (walletMoneyVN > totalMoneyDepositVN) {
                            $.ajax({
                                url: '{{ route("update-done-wallet-transfer") }}',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    total_payment_deposit_vn: totalMoneyDepositVN,
                                    product_names: productNames,
                                    order_id: orderID,
                                    payment_currency: paymentCurrency,
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log(response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }
                    }else if(paymentCurrency === '2'){
                        var totalMoneyDepositCN = parseInt({{$totalDepositChinese}}, 10);
                        var walletMoneyCN = parseInt({{$currentWalletMoney->middle_money}}, 10);

                        if(walletMoneyCN > totalMoneyDepositCN){
                            $.ajax({
                                url: '{{ route("update-done-wallet-transfer") }}',
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    total_payment_deposit_cn: totalMoneyDepositCN,
                                    product_names: productNames,
                                    order_id: orderID,
                                    payment_currency: paymentCurrency,
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        console.log(response.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error(error);
                                }
                            });
                        }
                    }
                }

                var prepaidModal = new bootstrap.Modal(document.getElementById('modalPrepaid'));
                prepaidModal.show();
            } else if (selectedPaymentMethod === 'bank') {
                var bankModal = new bootstrap.Modal(document.getElementById('modalBankTransfer'));
                bankModal.show();
            } else {
                alert('Vui lòng chọn phương thức thanh toán!');
            }
        }

        function copyToClipboard(elementId) {
            var copyText = document.getElementById(elementId);
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
        }

        function copyToClipboardText(elementId) {
            var textToCopy = document.getElementById(elementId).innerText;
            navigator.clipboard.writeText(textToCopy).then(function() {
                console.log("Copied:", textToCopy);
            }).catch(function(err) {
                console.error("Failed to copy text: ", err);
            });
        }

        $('#done-bank-transfer').on('click', function() {
            var productNames = [];
            $('.product-names').each(function() {
                productNames.push($(this).val());
            });

            var modalBankTransfer = bootstrap.Modal.getInstance(document.getElementById('modalBankTransfer'));

            $.ajax({
                url: '/update-done-bank-transfer',
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    product_names: productNames,
                    order_id: orderID
                },
                success: function(response) {
                    console.log(response);
                    if (modalBankTransfer) {
                        modalBankTransfer.hide();
                    }
                    var bankCompleteModal = new bootstrap.Modal(document.getElementById('bankComplete'));
                    bankCompleteModal.show();
                },
                error: function(xhr, status, error) {
                    console.log('Error:', error);
                }
            });
        });

    </script>
@stop
