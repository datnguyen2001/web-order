@extends('web.index')
@section('title','Giỏ hàng')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/cart.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <img src="https://sabomall.com/banner/banner-top.png" class="img-search-1">
            <img src="https://sabomall.com/banner/chrome-ext-2.png" class="img-search-2">
        </div>

        <div class="header-cart-detail custom-shadow">
            <p class="title-total-sp">Tổng (4/200)</p>
            <div class="header-table-cart">
                <div class="tick_sp_all">
                    <input type="checkbox" id="total_sp_all select_all" class="select_all" style="margin-right: 5px">
                    <lable for="select_all">Chọn tất cả</lable>
                </div>
                <div class="title-header-sp">Tên sản phẩm</div>
                <div class="title-header-quantity text-center">Số lượng</div>
                <div class="title-header-price" style="text-align: right">Đơn giá</div>
                <div class="title-header-total-price" style="text-align: right">Tổng giá</div>
            </div>
        </div>

        @for($i=0;$i<2;$i++)
        <div class="header-cart-detail custom-shadow ">
            <div class="shop_sp_all">
                <input type="checkbox" id="total_sp_all" class="shop-checkbox">
                <img src="https://sabomall.com/cart/icon_1688.png" style="width: 60px">
                <lable>鸿源凯诺渔具厂(Hongyuan Kainuo Fishing Tackle Factory)</lable>
            </div>
            @for($i=0;$i<2;$i++)
            <div class="line_item_cart">
                <div class="d-flex align-items-center gap-2">
                    <input type="checkbox" class="product-checkbox">
                    <img src="https://cbu01.alicdn.com/img/ibank/O1CN01pWZ1131CFrUEJK51s_!!2212814650052-0-cib.jpg" class="img-sp-cart">
                    <a href="" class="title-detail-sp title-detail-sp-mobile">Cần câu LEO bằng carbon cắm vào cần câu LEO bằng cần câu miệng ngựa bán buôn cần câu bắn xa siêu nhẹ và cứng M</a>
                </div>
                <div class="content-line-cart-item position-relative">
                    <a href="" class="title-detail-sp title-detail-sp-desktop">Cần câu LEO bằng carbon cắm vào cần câu LEO bằng cần câu miệng ngựa bán buôn cần câu bắn xa siêu nhẹ và cứng M</a>
                    <div class="box-attribute-cart-sp ">
                        <div class="line-item-detail-attribute">
                            <img src="https://cbu01.alicdn.com/img/ibank/O1CN01J7Vomv1vvgQrlP7DS_!!3377416235-0-cib.jpg" class="img-sp-attribute">
                            <div class="box-name-attribute-cart">Titan ba lớp sợi nhỏ [màu ngẫu nhiên] một cặp kích thước</div>
                        </div>
                        <div class="line-item-detail-quantity-attribute">
                            <div class="box-quantity-fa">
                                <button class="btn-minus-plus btn-minus"><i class="fa-solid fa-minus"></i></button>
                                <input type="number" class="input-quantity" value="0">
                                <button class="btn-minus-plus btn-plus"><i class="fa-solid fa-plus"></i></button>
                            </div>
                            <button class="icon-item-delete-attribute"><i class="fa-regular fa-trash-can"></i></button>

                        </div>
                        <div class="line-item-detail-price-attribute">
                            <span class="title-price-attribute">¥40,00</span>
                            <span class="title-price-small-attribute">145.800₫</span>
                        </div>
                        <div class="line-item-detail-price-attribute">
                            <span class="title-price-attribute" style="color: #F9471B">¥40,00</span>
                            <span class="title-price-small-attribute" style="color: #F9471B">145.800₫</span>
                        </div>
                    </div>
                    <button class="btn-delete-cart-shop"><i class="fa-regular fa-trash-can"></i></button>
                </div>
            </div>
            @endfor

        </div>
@endfor

        <div class="box-bottom-pay-cart custom-shadow">
            <div class="d-flex align-items-center gap-4">
                <div class="box-add-all-to-cart">
                    <input type="checkbox" id="total_sp_all select_all_bottom" class="select_all_bottom">
                    <lable for="select_all_bottom">Chọn tất cả</lable>
                </div>
                <button class="btn-delete-all-cart"><i class="fa-regular fa-trash-can" style="margin-right: 5px"></i> Xóa bỏ</button>
            </div>
            <div class="d-flex align-items-center justify-content-between line-all-price-pick gap-4">
                <div class="title-total-price-all-cart">
                    Tổng: <span>0</span>
                    (0đ)
                </div>
                <button class="btn-buy-cart" data-bs-toggle="modal" data-bs-target="#staticBackdropAddress">Mua Hàng</button>
            </div>

        </div>

    </div>

    <!-- Modal address-->
    <div class="modal fade" id="staticBackdropAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address" id="staticBackdropLabel">Thêm địa chỉ nhận hàng</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Người nhận hàng <span style="color: #F9471B">*</span></span>
                        <input type="text" class="input-form-address" placeholder="Tên người nhận hàng" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Số điện thoại <span style="color: #F9471B">*</span></span>
                        <input type="text" class="input-form-address" placeholder="Số điện thoại" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Tỉnh/Thành phố <span style="color: #F9471B">*</span></span>
                        <select name="" class="input-form-address" required>
                            <option value="">Chọn tỉnh/thành phố</option>
                            <option value="">Hà Nội</option>
                            <option value="">Hồ Chí Minh</option>
                        </select>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Quận/Huyện <span style="color: #F9471B">*</span></span>
                        <select name="" class="input-form-address" required>
                            <option value="">Chọn quận/huyện</option>
                            <option value="">Hà Nội</option>
                            <option value="">Hồ Chí Minh</option>
                        </select>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Phường/Xã <span style="color: #F9471B">*</span></span>
                        <select name="" class="input-form-address" required>
                            <option value="">Chọn phường/xã</option>
                            <option value="">Hà Nội</option>
                            <option value="">Hồ Chí Minh</option>
                        </select>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Địa chỉ cụ thể <span style="color: #F9471B">*</span></span>
                        <input type="text" class="input-form-address" placeholder="Địa chỉ cụ thể" required>
                    </div>
                    <div class="w-100 d-flex align-items-center">
                        <input type="checkbox" id="">
                        <lable class="title-form-address mb-0 mx-2">Đặt làm địa chỉ giao hàng mặc định</lable>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-dismiss-address" data-bs-dismiss="modal">Hủy Bỏ</button>
                    <button type="button" class="btn btn-primary btn-success-address">Xác Nhận</button>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script_page')
    <script src="{{asset('assets/js/cart.js')}}"></script>
@stop
