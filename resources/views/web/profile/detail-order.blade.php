@extends('web.index')
@section('title','Chi tiết đơn hàng')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/pay.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
    <style>
        .main {
            padding-bottom: 80px;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <div class="box-search-order custom-shadow mt-0">
            <p class="title-search-order">Trạng thái: <span style="color: #F9471B">Đã bị huỷ</span></p>
        </div>

        <div class="box-search-order custom-shadow d-flex justify-content-between flex-wrap gap-2">
            <div class="box-one-info">
                <p class="title-info-order">Thông tin đơn hàng</p>
                <div class="content-info-order">Mã đơn hàng: <span style="color:#F9471B;font-weight: 500;margin-left: 15px">SA8UR59</span></div>
            </div>
            <div class="box-one-info">
                <p class="title-info-order">Thông Tin Người Nhận</p>
                <div class="content-info-order">Nguyễn(123121231)</div>
                <div class="content-info-order">123, Phường 01, Quận 10, Thành phố Hồ Chí Minh</div>
            </div>
            <div class="box-one-info">
                <p class="title-info-order">Cần Thanh Toán</p>
                <div class="price-info-order">¥329,57 <span style="font-size: 12px;color:#6F6F6F;font-weight: 400;">(1.194.692₫)</span></div>
            </div>
        </div>

        <div class="box-content-order">

                <div class="box-order-item p-2 mt-0">
                    <div class="item-order-left">
                        <div class="line-table-header">
                            <span>Sản phẩm</span>
                            <span>Đơn giá</span>
                            <span>Số lượng</span>
                            <span>Thành tiền</span>
                        </div>

                        @for($i=0;$i<2;$i++)
                            <div class="item-product-order mb-4">
                                <div class="w-100 d-flex gap-2 align-items-center mb-2">
                                    <span>1</span>
                                    <img src="https://global-img-cdn.1688.com/img/ibank/O1CN01PgvQMg1IloidmbXdn_!!2208204380934-0-cib.jpg" class="img-sp-order">
                                    <div class="d-flex flex-column">
                                        <div class="name-product-item custom-content-2-line">Xuyên biên giới Trạm độc lập Amazon Hữu nghị Mặt dây chuyền gỗ Cây Giáng sinh Trang trí Mặt Dây chuyền Giáng sinh Gia đình Ô tô Mặt dây chuyền</div>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <div class="title-menu-order">Số lượng: <b>3</b></div>
                                            <div class="title-menu-order">Thuộc tính: <b>2</b></div>
                                            <div class="d-flex flex-column align-items-end">
                                                <span class="price-sale-total-sp">¥8,40</span>
                                                <span class="price-total-sp">30.618₫</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @for($j=0;$j<2;$j++)
                                    <div class="item-attribute-product mb-2">
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="https://global-img-cdn.1688.com/img/ibank/O1CN01PgvQMg1IloidmbXdn_!!2208204380934-0-cib.jpg" class="img-sp-attr-order">
                                            <div class="name-attr-sp">
                                                Màu sắc: <b>Đỏ</b>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="price-total-sp" style="font-weight: 600">¥8,40</span>
                                            <span class="price-total-sp">30.618₫</span>
                                        </div>
                                        <div style="font-size: 14px;color: #6F6F6F">2</div>
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="price-total-sp" style="font-weight: 600">¥8,40</span>
                                            <span class="price-total-sp">30.618₫</span>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        @endfor
                        <div class="d-flex align-items-center">
                            <input type="checkbox">
                            <label for="" style="color: #1a1a1a;font-size: 12px;margin-left: 5px;margin-bottom: 1px"> Kiểm hàng</label>
                        </div>
                        <div class="w-100 d-flex flex-column gap-1 mt-3 mb-3">
                            <span style="font-size: 12px;color: #111827">Ghi chú đơn hàng</span>
                            <textarea name="" class="note-order" rows="5" placeholder="Ghi chú (Enter để xuống dòng)"></textarea>
                        </div>
                    </div>
                    <div class="item-order-right">
                        <div class="item-child-price">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="title-item-child-price">Vốn Hàng Hóa (85%)</span>
                                <div class="d-flex flex-column align-items-end">
                                    <span class="price-total-sp" style="font-weight: 600;font-size: 16px">¥8,40</span>
                                    <span class="price-total-sp">30.618₫</span>
                                </div>
                            </div>
                            <div class="line-title-item-child-price">
                                <span>1. Tiền hàng</span>
                                <span>¥59,40</span>
                            </div>
                            <div class="line-title-item-child-price">
                                <span>2. Phí vận chuyển nội địa TQ</span>
                                <span>Đang cập nhật</span>
                            </div>
                            <div class="line-title-item-child-price">
                                <span>3. Giảm giá</span>
                                <span>Đang cập nhật</span>
                            </div>
                        </div>
                        <div class="item-child-price line-top-child-price">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="title-item-child-price">Phí nhập hàng (15%)</span>
                                <div class="d-flex flex-column align-items-end">
                                    <span class="price-total-sp" style="font-weight: 600;font-size: 16px">¥8,40</span>
                                    <span class="price-total-sp">30.618₫</span>
                                </div>
                            </div>
                            <div class="line-title-item-child-price">
                                <span>1. Phí vận chuyển quốc tế</span>
                                <span>¥59,40</span>
                            </div>
                            <div class="line-title-item-child-price">
                                <span>2. Phí vận chuyển nội địa Việt Nam</span>
                                <span>¥3,30</span>
                            </div>
                            <div class="line-title-item-child-price">
                                <span>3. Phí dịch vụ đảm bảo hàng hoá</span>
                                <span>¥0,47</span>
                            </div>
                            <div class="line-title-item-child-price">
                                <span>3. Phí thanh toán 1 phần</span>
                                <span>¥0,47</span>
                            </div>
                        </div>
                        <div class="item-child-price line-top-child-price">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="title-item-child-price-all">Tổng Chi Phí</span>
                                <div class="d-flex flex-column align-items-end">
                                    <span class="price-total-sp-all-big">¥8,40</span>
                                    <span class="price-total-sp-all">30.618₫</span>
                                </div>
                            </div>
                        </div>
                        <div class="item-child-price pt-0">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <span class="title-item-child-price-all" style="font-size: 15px">Đã Thanh Toán:</span>
                                <div class="d-flex flex-column align-items-end">
                                    <span class="price-total-sp-all-big" style="color: rgb(58 161 117/ 1);font-size: 15px">¥0</span>
                                    <span class="price-total-sp-all" style="color: rgb(58 161 117/ 1);font-size: 15px">0₫</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>

    </div>


@stop
@section('script_page')

@stop
