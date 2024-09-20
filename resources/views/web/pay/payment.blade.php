@extends('web.index')
@section('title','Thanh toán')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/pay.css')}}">
    <style>
        .main {
            min-height: 100vh;
            height: 100%;
            background: white;
            padding-bottom: 20px!important;
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
                    <p class="title-header-payment">Tổng cộng <span>2</span> đơn hàng</p>
                    <p class="title-header-payment">*Tiền vốn bao gồm (tiền hàng + phí vận chuyển nội địa TQ)</p>
                </div>

                @for($i=0;$i<5;$i++)
                    <div class="item-sp-payment">
                        <div class="d-flex align-items-center">
                            <img src="https://cbu01.alicdn.com/img/ibank/O1CN01G8JYxA1OnY26I4PLG_!!1008171750-0-cib.jpg"
                                 class="img-sp-payment">
                            <div class="d-flex flex-column gap-2">
                                <div class="name-col-sp">Đơn hàng: <span>SA85THU</span></div>
                                <div class="name-col-sp">Số lượng: <span>8 sản phẩm</span></div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between align-items-end flex-column gap-2">
                            <div class="name-col-money">Tiền vốn: <span>139.968₫</span></div>
                            <div class="name-col-money">Đặt cọc: <span>62.986₫</span></div>
                        </div>
                    </div>
                @endfor

                <div class="line-money-payment">
                    <div class="title-total-payment">Tổng cộng tiền vốn:</div>
                    <div class="name-total-money-payment">251.505đ</div>
                </div>
                <div class="line-money-payment" style="margin-top: 13px">
                    <div class="title-total-payment-big">CẦN ĐẶT CỌC TRƯỚC:</div>
                    <div class="name-total-money-payment-big">251.505đ</div>
                </div>

            </div>
            <div class="content-item-pay-right custom-shadow">
                <div class="d-flex align-items-center justify-content-between mb-3 flex-wrap">
                    <div class="title-payment-method">Phương Thức Thanh Toán</div>
                    <div class="name-payment-method">Tiền tệ thanh toán: <span class="face-value">đ</span><span class="name-dv">VNĐ</span></div>
                </div>

                <div class="payment-method-container">
                    <div class="payment-method" onclick="selectPaymentMethod(this)">
                        <img src="{{asset('assets/images/icon-payment-method-prepaid.png')}}" alt="Wallet" class="payment-method-icon">
                        <div class="payment-method-info">
                            <strong>Tài khoản trả trước</strong>
                            <small>Số dư: 0₫ </small>
                        </div>
                        <span class="checkmark"></span>
                    </div>
                    <div class="payment-method" onclick="selectPaymentMethod(this)">
                        <i class="fa-solid fa-qrcode"></i>
                        <div class="payment-method-info">
                            <strong>Chuyển khoản ngân hàng</strong>
                        </div>
                        <span class="checkmark"></span>
                    </div>
                </div>



                <div class="name-note-payment">Bằng việc đặt hàng, bạn đồng ý rằng đơn hàng được uỷ thác, vận chuyển thông qua 1688 Global và đồng ý với điều khoản dịch vụ của 1688 Global và SaboMall
                </div>
                <button class="btn-payment-now" data-bs-toggle="modal" data-bs-target="#switchBanks">Thanh Toán</button>
            </div>
        </div>

    </div>

    <!-- Modal bank -->
    <div class="modal fade" id="switchBanks" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="switchBanksLable" aria-hidden="true">
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
                    <div class="name-money-bank">Thanh toán trước: <span>55.259₫</span></div>
                    <p class="note-banking">Vui lòng chỉ thanh toán qua hệ thống SaboMall để đảm bảo an toàn</p>
                    <div class="note-money-banking">
                        <i class="fa-solid fa-circle-info"></i>
                        <div class="name-note-banking">
                            Lưu ý: Giao dịch chuyển khoản dưới <span>100.000đ</span> có thể mất nhiều thời gian để được xác nhận do thông báo từ Ngân hàng. Số tiền thanh toán thừa sẽ được cộng vào tài khoản trả trước của bạn để thanh toán các lần tiếp theo.
                        </div>
                    </div>
                    <div class="line-info-banking">
                        Số tiền: <input type="number" class="input-money-banking" value="100.000">
                    </div>
                    <div class="line-info-banking">
                        Ngân hàng: <span>Ngân hàng TMCP Đầu tư và Phát triển Việt Nam</span>
                    </div>
                    <div class="line-info-banking">
                        Số tài khoản: <span>8850377934</span>
                    </div>
                    <div class="line-info-banking">
                        Nội dung: <span>CK ZGZ6C1YGQYQWT</span>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="button" class="btn btn-transferred-money" data-bs-toggle="modal" data-bs-target="#bankComplete">Tôi Đã Chuyển Khoản</button>
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
        function selectPaymentMethod(element) {
            document.querySelectorAll('.payment-method').forEach(method => {
                method.classList.remove('selected');
                method.querySelector('.checkmark').classList.remove('selected');
            });
            element.classList.add('selected');
            element.querySelector('.checkmark').classList.add('selected');
        }
    </script>
@stop
