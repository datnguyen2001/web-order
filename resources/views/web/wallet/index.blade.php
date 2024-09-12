@extends('web.index')
@section('title','Quản lý ví')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/wallet.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">
        <div class="box-header-wallet">
            <div class="box-one-wallet custom-shadow">
                <div class="name-user-wallet">Chào mừng quay lại <span>pikopi01</span></div>
                <div class="content-more-wallet">Thanh toán dễ dàng, nhanh chóng cho các đơn hàng xuyên biên giới. Mọi giao dịch của bạn được bảo mật theo tiêu chuẩn cao nhất</div>
                <a href="#" class="title-back-home"><i class="fa-solid fa-house"></i> Quay lại SaboMall.com</a>
            </div>
            <div class="box-two-wallet custom-shadow">
                <div class="title-price">¥</div>
                <div class="name-price">VIỆT NAM ĐỒNG</div>
                <div class="number-price">0đ</div>
            </div>
            <div class="box-two-wallet custom-shadow">
                <div class="title-price" style="color: #F9471B;background: rgba(249, 71, 27, .1)">đ</div>
                <div class="name-price">NHÂN DÂN TỆ</div>
                <div class="number-price d-flex justify-content-between align-items-center"><span>¥0</span>
                    <button class="btn-recharge" data-bs-toggle="modal" data-bs-target="#exampleModalWallet">Nạp tiền</button></div>
            </div>
        </div>

        <div class="box-transaction-history custom-shadow">
            <div class="line-transaction-history">
                <div class="title-transaction-history">Lịch Sử Giao Dịch</div>
                <input type="text" class="search-transaction-history">
                <input type="date" class="search-transaction-history">
            </div>

            <div class="table-transaction-history">
                <div class="body-transaction-history">
                    <div class="header-transaction-history">
                        <div class="title-time">Thời gian</div>
                        <div class="title-content">Nội dung</div>
                        <div class="title-value text-center">Giá trị</div>
                        <div class="title-balance" style="text-align: right">Số dư sau giao dịch</div>
                    </div>
                    <div class="box-content-transaction-history">
                        <div class="title-time d-flex flex-column gap-2">
                            <span class="time-history">09:39 29/08/2024</span>
                            <span class="content-history">Mã GD: T439374964793032704</span>
                        </div>
                        <div class="title-content d-flex flex-column justify-content-center time-history">Giao dịch khởi tạo tài khoản pikopi</div>
                        <div class="title-value d-flex flex-column justify-content-center text-center time-history">0</div>
                        <div class="title-balance d-flex flex-column justify-content-center time-history" style="font-weight: 500;text-align: right">0đ</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Modal wallet-->
    <div class="modal fade" id="exampleModalWallet" tabindex="-1" aria-labelledby="exampleModalWalletLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address" id="staticEditUserLabel">Nạp tiền</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center pb-5">
                    <a href="#" class="link-recharge">Hướng dẫn nạp tiền</a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script_page')

@stop
