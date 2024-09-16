@extends('web.index')
@section('title','Quản lý ví')

@section('style_page')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="{{asset('assets/css/wallet.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">
        <div class="box-header-wallet">
            <div class="box-one-wallet custom-shadow">
                <div class="name-user-wallet">Chào mừng quay lại <span>{{$user->full_name}}</span></div>
                <div class="content-more-wallet">Thanh toán dễ dàng, nhanh chóng cho các đơn hàng xuyên biên giới. Mọi
                    giao dịch của bạn được bảo mật theo tiêu chuẩn cao nhất
                </div>
                <a href="{{route('home')}}" class="title-back-home"><i class="fa-solid fa-house"></i> Quay lại SaboMall.com</a>
            </div>
            <a href="{{url('lich-su-giao-dich/vi')}}" class="box-two-wallet @if($walletType == 1) wallet-active @endif custom-shadow">
                <div class="title-price">đ</div>
                <div class="name-price">VIỆT NAM ĐỒNG</div>
                <div class="number-price">{{number_format($wallet->vietnamese_money)}}đ</div>
            </a>

                <a href="{{url('lich-su-giao-dich/cq')}}" class="box-two-wallet @if($walletType == 2) wallet-active @endif custom-shadow">
                    <div class="title-price" style="color: #F9471B;background: rgba(249, 71, 27, .1)">¥</div>
                    <div class="name-price">NHÂN DÂN TỆ</div>
                    <div class="number-price d-flex justify-content-between align-items-center">
                        <span>¥{{number_format($wallet->middle_money)}}</span>
                        <button class="btn-recharge" data-bs-toggle="modal" data-bs-target="#exampleModalWallet">Nạp tiền</button>
                    </div>
                </a>

        </div>

        <div class="box-transaction-history custom-shadow">
            <form action="{{route('wallet',$name)}}" class="d-flex align-items-center mb-3" method="GET">
                <div class="line-transaction-history">
                    <div class="title-transaction-history">Lịch Sử Giao Dịch</div>
                    <input type="text" class="search-transaction-history" name="transaction_code" placeholder="Mã giao dịch" value="{{request()->get('transaction_code')}}">
                    <input type="text" id="date_range" class="search-transaction-history" placeholder="Thời gian" name="date_range" value="{{request()->get('date_range')}}">
                    <button type="submit" class="btn btn-success">Tìm kiếm</button>
                    <a href="{{route('wallet',$name)}}" class="btn btn-danger">Hủy</a>
                </div>
            </form>

            <div class="table-transaction-history">
                <div class="body-transaction-history">
                    <div class="header-transaction-history">
                        <div class="title-time">Thời gian</div>
                        <div class="title-content">Nội dung</div>
                        <div class="title-value text-center">Giá trị</div>
                        <div class="title-balance" style="text-align: right">Số dư sau giao dịch</div>
                    </div>
                    @if(count($listData)>0)
                    @foreach($listData as $item)
                        <div class="box-content-transaction-history">
                            <div class="title-time d-flex flex-column gap-2">
                                <span
                                    class="time-history">{{ \Carbon\Carbon::parse($item->created_at)->format('H:i d/m/Y') }}</span>
                                <span class="content-history">Mã GD: {{$item->transaction_code}}</span>
                            </div>
                            <div
                                class="title-content d-flex flex-column justify-content-center time-history">{{$item->description}}</div>
                            <div
                                class="title-value d-flex flex-column justify-content-center text-center time-history">{{number_format($item->amount)}}</div>
                            <div class="title-balance d-flex flex-column justify-content-center time-history"
                                 style="font-weight: 500;text-align: right">{{number_format($item->new_balance)}}@if($walletType == 1)
                                    đ @else ¥ @endif</div>
                        </div>
                    @endforeach
                        <div class="d-flex justify-content-center mt-2">
                            {{ $listData->appends(request()->all())->links('admin.pagination_custom.index') }}
                        </div>
                        @else
                        <div class="text-center" style="color: #F9471B;margin-top: 10px">Không có dữ liệu</div>
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!-- Modal wallet-->
    <div class="modal fade" id="exampleModalWallet" tabindex="-1" aria-labelledby="exampleModalWalletLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address" id="staticEditUserLabel">Nạp tiền</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center pb-5">
                    <a href="#" class="link-recharge">Hướng dẫn nạp tiền</a>
                </div>
            </div>
        </div>
    </div>
@stop
@section('script_page')
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var btnRecharge = document.querySelector('.btn-recharge');
        var linkWallet = document.querySelector('#link-wallet');

        btnRecharge.addEventListener('click', function(event) {
            event.stopPropagation();
            event.preventDefault();
        });
        $(function() {
            $('#date_range').on('focus', function() {
                $('#date_range').daterangepicker({
                    locale: {
                        format: 'YYYY-MM-DD',
                        applyLabel: "Apply",
                        cancelLabel: "Cancel",
                        customRangeLabel: "Custom Range"
                    },
                    ranges: {
                        'Hôm nay': [moment(), moment()],
                        'Hôm qua': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        '7 Ngày trước': [moment().subtract(6, 'days'), moment()],
                        '30 Ngày trước': [moment().subtract(29, 'days'), moment()],
                        'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                        'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    opens: 'left'
                });
            });
        });
    </script>
@stop
