@extends('web.index')
@section('title','Xác nhận đơn')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/pay.css')}}">
    <style>
        @media (max-width: 1200px) {
            .main {
                padding-bottom: 197px;
            }
            .box-menu-pay-footer{
                bottom: 70px;
            }
        }
        @media (max-width: 1100px) {
            .main {
                padding-bottom: 255px;
            }
        }
        @media (max-width: 585px) {
            .main {
                padding-bottom: 280px;
            }
        }
        @media (max-width: 531px) {
            .main {
                padding-bottom: 75px;
            }
            .box-menu-pay-footer{
                position: unset;
                margin-top: 18px;
            }
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

       <div class="box-shipping-unit shadow-lg">
           <p class="title-shipping-unit">Vận chuyển Trung Quốc - Việt Nam</p>
           <div class="w-100 d-flex align-items-center">
               <span class="title-delivered">Giao đến: </span>
               <i class="fa-solid fa-truck" style="color: #0f5132;font-size: 16px;margin-right: 8px"></i>
               @if($address)
               <div class="d-flex align-items-center text-detail-address">
                   <b style="margin-right: 3px">{{$address->name}}</b>
                   <span>{{$address->detail_address}}, {{$address->ward->name}}, {{$address->district->name}}, {{$address->province->name}}, {{$address->phone}}</span>
               </div>
               <div class="text-change" data-bs-toggle="modal" data-bs-target="#staticBackdropSelectAddress">Thay đổi</div>
                   @else
                   <div class="text-change" data-bs-toggle="modal" data-bs-target="#staticBackdropAddress">Thêm địa chỉ nhận hàng</div>
               @endif
           </div>
       </div>

        <div class="box-order-item shadow-lg">
            <div class="item-order-left">
{{--                <p class="title-order-number">Đơn hàng 1</p>--}}
{{--                <div class="line-title-shop">--}}
{{--                    <img src="https://sabomall.com/cart/icon_1688.png" style="width: 56px">--}}
{{--                    <a href="">--}}
{{--                        义乌市涵许电子商务商行 <span>(Công ty thương mại điện tử Hanxu thành phố Nghĩa Ô)</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
                <div class="line-table-header">
                    <span>Sản phẩm</span>
                    <span>Đơn giá</span>
                    <span>Số lượng</span>
                    <span>Thành tiền</span>
                </div>

                @php
                    $groupedProducts = $selectedProducts->groupBy('product_name');
                @endphp

                @foreach($groupedProducts as $productName => $products)
                <div class="item-product-order mb-4">
                    <div class="w-100 d-flex gap-2 align-items-center mb-2">
                        <span>{{ $loop->iteration }}</span>
                        <img src="{{$products[0]->product_image}}" class="img-sp-order">
                        <div class="d-flex flex-column w-100">
                            <div class="name-product-item custom-content-2-line">{{$productName}}</div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="title-menu-order">Số lượng: <b>{{ $products->sum('quantity') }}</b></div>
                                <div class="title-menu-order">Thuộc tính: <b>{{ $products->count() }}</b></div>
                                @php
                                    $totalChinesePrice = $products->sum(function($product) {
                                        return floatval($product->chinese_price ?? 0) * ($product->quantity ?? 1);
                                    });
                                    $totalVietnamesePrice = $products->sum(function($product) {
                                        return floatval($product->vietnamese_price ?? 0) * ($product->quantity ?? 1);
                                    });
                                @endphp
                                <div class="d-flex flex-column align-items-end">
                                    <span class="price-sale-total-sp">¥{{ number_format($totalChinesePrice, 0, ',', '.') }}</span>
                                    <span class="price-total-sp">{{ number_format($totalVietnamesePrice, 0, ',', '.') }}₫</span>
                                </div>

                            </div>
                        </div>
                    </div>
                    @foreach($products as $product)
                    <div class="item-attribute-product mb-2">
                        <div class="d-flex align-items-center gap-3" style="width: 50%;">
                            <img src="{{$product->product_value_image}}" class="img-sp-attr-order">
                            <div class="name-attr-sp">
                                Đặc điểm: <b>{{$product->product_value ?? 'N/A'}}</b>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <span class="price-total-sp" style="font-weight: 600">¥{{number_format(floatval($product->chinese_price ?? 0), 0, ',', '.')}}</span>
                            <span class="price-total-sp">{{number_format(floatval($product->vietnamese_price ?? 0), 0, ',', '.')}}₫</span>
                        </div>
                        <div style="font-size: 14px;color: #6F6F6F">{{$product->quantity ?? 0}}</div>
                        <div class="d-flex flex-column align-items-end">
                            <span class="price-total-sp" style="font-weight: 600">¥{{ number_format(floatval($product->chinese_price ?? 0) * ($product->quantity ?? 1), 0, ',', '.') }}</span>
                            <span class="price-total-sp">{{ number_format(floatval($product->vietnamese_price ?? 0) * ($product->quantity ?? 1), 0, ',', '.') }}₫</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
                <div class="d-flex align-items-center">
                    <input type="checkbox">
                    <label for="" style="color: #1a1a1a;font-size: 12px;margin-left: 5px;margin-bottom: 1px"> Kiểm hàng</label>
                </div>
                <div class="w-100 d-flex flex-column gap-1 mt-3 mb-3">
                    <span style="font-size: 12px;color: #111827">Ghi chú đơn hàng</span>
                    <textarea name="" class="note-order" rows="5" placeholder="Ghi chú (Enter để xuống dòng)"></textarea>
                </div>
            </div>
            @php
                $totalChinesePriceAllProducts = $selectedProducts->sum(function($product) {
                    return floatval($product->chinese_price ?? 0) * ($product->quantity ?? 1);
                });
            @endphp
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
                        <span>¥{{ number_format($totalChinesePriceAllProducts, 0, ',', '.') }}</span>
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
            </div>
        </div>

        <div class="box-footer-bottom-total shadow-lg">
            <div class="line-one-left-bottom ">
                <img src="https://sabomall.com/icons/icon-1688xsabo.jpg" class="img-clause">
                <div class="title-clause">Bằng việc đặt hàng, bạn đồng ý rằng đơn hàng được uỷ thác, vận chuyển thông qua 1688 Global và đồng ý với điều khoản dịch vụ của 1688 Global và SaboMall</div>
            </div>
            <div class="line-two-left-bottom">
                <div class="title-bottom-total-price">TỔNG CHI PHÍ <span>(2 đơn hàng)</span></div>
                <div class="d-flex flex-column align-items-end">
                    <span class="total-all-sp-price" style="font-weight: 600">¥8,40</span>
                    <span class="total-all-sp-price-small">30.618₫</span>
                </div>
            </div>
        </div>

        <div class="box-menu-pay-footer shadow-lg">
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="name-pay">Thanh toán</span>
                    <div class="btn-money-vn">
                        <span>đ</span>
                        Việt Nan Đồng
                    </div>
                    <div class="btn-money-tq">
                        <span>¥</span>
                        Nhân Dân Tệ <div>(¥1 = 3.645₫)</div>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-2 flex-wrap">
                    <span class="name-pay">Đặt cọc trước vốn hàng hóa</span>
                    <div class="d-flex align-items-center gap-3 flex-wrap">
                        <div class="d-flex align-items-center">
                            <input type="radio">
                            <div class="name-price-percent">45% <span>| Phí </span> <b style="color:#1a1a1a;font-size: 12px">¥1,79</b><span>(6.525₫)</span></div>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="radio">
                            <div class="name-price-percent">70% </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <input type="radio">
                            <div class="name-price-percent">Toàn bộ vốn hàng hóa</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-3 justify-content-end line-mobile-pay-now">
            <div class="box-name-note-pay">
                <div class="text-note-pay">Đặt cọc <span><b class="total-price-order">¥80,73</b> (294.261₫)</span></div>
                <div class="text-end-note-pay">Tiền hàng còn lại và phí vận chuyển sẽ thanh toán khi nhận hàng</div>
            </div>
            <a href="" class="btn-buy-now">Lên Đơn Ngay</a>
            </div>

        </div>

    </div>

    <!-- Modal select address -->
    <div class="modal fade" id="staticBackdropSelectAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropSelectAddress" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address" id="staticBackdropLabel">Chọn địa chỉ kho của đơn vị vận chuyển</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="address-container">
                        @foreach($listAddress as $itemAddress)
                        <div class="address-card @if($itemAddress->is_default == 1) selected @endif" data-id="{{ $itemAddress->id }}" onclick="selectAddress(this)">
                            <div class="address-info">
                                <span class="radio-btn @if($itemAddress->is_default == 1) selected @endif"></span>
                                <div class="detail-name-address">
                                    <strong>{{$itemAddress->name}}</strong> ({{$itemAddress->phone}})<br>
                                    {{$itemAddress->detail_address}}, {{$itemAddress->ward->name}}, {{$itemAddress->district->name}}, {{$itemAddress->province->name}}
                                    <br>
                                    @if($itemAddress->is_default == 1)
                                    <span class="default-tag">Đang chọn</span>
                                    @endif
                                </div>
                            </div>
                            <a class="update-link" data-bs-toggle="modal" data-bs-target="#staticUpdateAddress" data-id="{{ $itemAddress->id }}"
                               data-name="{{ $itemAddress->name }}" data-phone="{{ $itemAddress->phone }}"
                               data-province="{{ $itemAddress->province_id }}" data-district="{{ $itemAddress->district_id }}"
                               data-ward="{{ $itemAddress->ward_id }}" data-detail="{{ $itemAddress->detail_address }}" data-is_default="{{ $itemAddress->is_default }}">Cập Nhật</a>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-between flex-wrap align-items-center">
                    <button class="btn-plus-address" type="button" data-bs-toggle="modal" data-bs-target="#staticBackdropAddress"><i class="fa-solid fa-plus"></i> Thêm Mới Địa Chỉ</button>
                   <div class="d-flex align-items-center gap-2">
                       <button type="button" class="btn btn-secondary btn-dismiss-address" data-bs-dismiss="modal">Hủy Bỏ</button>
                       <button type="submit" class="btn btn-primary btn-success-address" onclick="submitSelectedAddress()">Xác Nhận</button>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal update address-->
    <div class="modal fade" id="staticUpdateAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address" id="staticBackdropLabel">Cập nhật địa chỉ nhận hàng</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="address-form" action="{{route('update-address')}}" method="POST">
                    @csrf
                <div class="modal-body pt-0">
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Người nhận hàng <span style="color: #F9471B">*</span></span>
                        <input type="text" class="input-form-address" name="name" placeholder="Tên người nhận hàng" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Số điện thoại <span style="color: #F9471B">*</span></span>
                        <input type="text" class="input-form-address" name="phone" placeholder="Số điện thoại" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Tỉnh/Thành phố <span style="color: #F9471B">*</span></span>
                        <select name="province_id" class="input-form-address" id="provinceUpdate" required>
                            <option value="">Chọn tỉnh/thành phố</option>
                        </select>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Quận/Huyện <span style="color: #F9471B">*</span></span>
                        <select name="district_id" class="input-form-address" id="districtUpdate" required>
                            <option value="">Chọn quận/huyện</option>
                        </select>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Phường/Xã <span style="color: #F9471B">*</span></span>
                        <select name="ward_id" class="input-form-address" required>
                            <option value="">Chọn phường/xã</option>
                        </select>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Địa chỉ cụ thể <span style="color: #F9471B">*</span></span>
                        <input type="text" class="input-form-address" name="detail_address" placeholder="Địa chỉ cụ thể" required>
                    </div>
                    <div class="w-100 d-flex align-items-center">
                        <input type="checkbox" id="is_default" name="is_default">
                        <label for="is_default" class="title-form-address mb-0 mx-2">Đặt làm địa chỉ giao hàng mặc định</label>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary btn-dismiss-address" data-bs-dismiss="modal">Hủy Bỏ</button>
                    <button type="submit" class="btn btn-primary btn-success-address">Xác Nhận</button>
                </div>
                </form>
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
                <form id="address-form" action="{{route('address-new')}}" method="POST">
                    @csrf
                    <div class="modal-body pt-0">
                        <div class="w-100 d-flex flex-column mb-3">
                            <span class="title-form-address">Người nhận hàng <span style="color: #F9471B">*</span></span>
                            <input type="text" class="input-form-address" name="name" placeholder="Tên người nhận hàng" required>
                        </div>
                        <div class="w-100 d-flex flex-column mb-3">
                            <span class="title-form-address">Số điện thoại <span style="color: #F9471B">*</span></span>
                            <input type="text" class="input-form-address" name="phone" placeholder="Số điện thoại" required>
                        </div>
                        <div class="w-100 d-flex flex-column mb-3">
                            <span class="title-form-address">Tỉnh/Thành phố <span style="color: #F9471B">*</span></span>
                            <select name="province_id" class="input-form-address" id="province" required>
                                <option value="">Chọn tỉnh/thành phố</option>
                                @foreach($province as $provinces)
                                    <option value="{{$provinces->province_id }}">{{$provinces->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-100 d-flex flex-column mb-3">
                            <span class="title-form-address">Quận/Huyện <span style="color: #F9471B">*</span></span>
                            <select name="district_id" class="input-form-address" id="district" required>
                                <option value="">Chọn quận/huyện</option>

                            </select>
                        </div>
                        <div class="w-100 d-flex flex-column mb-3">
                            <span class="title-form-address">Phường/Xã <span style="color: #F9471B">*</span></span>
                            <select name="ward_id" class="input-form-address" id="ward" required>
                                <option value="">Chọn phường/xã</option>

                            </select>
                        </div>
                        <div class="w-100 d-flex flex-column mb-3">
                            <span class="title-form-address">Địa chỉ cụ thể <span style="color: #F9471B">*</span></span>
                            <input type="text" class="input-form-address" name="detail_address" placeholder="Địa chỉ cụ thể" required>
                        </div>
                        <div class="w-100 d-flex align-items-center">
                            <input type="checkbox" id="is_default" name="is_default">
                            <label for="is_default" class="title-form-address mb-0 mx-2">Đặt làm địa chỉ giao hàng mặc định</label>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary btn-dismiss-address" data-bs-dismiss="modal">Hủy Bỏ</button>
                        <button type="submit" class="btn btn-primary btn-success-address">Xác Nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop
@section('script_page')
    <script src="{{asset('assets/js/pay.js')}}"></script>
@stop
