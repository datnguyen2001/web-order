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
            <p class="title-total-sp">Tổng: {{ is_countable($cartItems) ? count($cartItems) : 0 }} sản phẩm</p>
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

        @php
            $groupedCartItems = $cartItems->groupBy('product_name');
        @endphp
        <div class="header-cart-detail custom-shadow ">
            @foreach($groupedCartItems as $productName => $items)
            <div class="line_item_cart">
                <div class="d-flex align-items-center gap-2">
                    @php
                        $totalChinesePrice = 0;
                        $totalVietnamesePrice = 0;
                        $productID = [];
                        foreach ($items as $item) {
                            $totalChinesePrice += floatval($item->chinese_price ?? 0) * ($item->quantity ?? 1);
                            $totalVietnamesePrice += floatval($item->vietnamese_price ?? 0) * ($item->quantity ?? 1);
                            $productID[] = $item->id;
                        }
                        $productIDsString = implode(',', $productID);
                    @endphp
                    <input type="checkbox" class="product-checkbox" data-product-id="{{$productIDsString}}" data-product-chinese-price="{{$totalChinesePrice}}" data-product-vietnamese-price="{{$totalVietnamesePrice}}">
                    <img src="{{$items[0]->product_image}}" class="img-sp-cart">
                    <a href="" class="title-detail-sp title-detail-sp-mobile">{{$productName ?? 'Product Name'}}</a>
                </div>
                <div class="content-line-cart-item position-relative">
                    <a href="" class="title-detail-sp title-detail-sp-desktop">{{$productName ?? 'Product Name'}}</a>
                    @foreach($items as $cartItem)
                        <div class="box-attribute-cart-sp ">
                            <div class="line-item-detail-attribute">
                                <img src="{{$cartItem->product_value_image}}" class="img-sp-attribute">
                                <div class="box-name-attribute-cart">{{($cartItem->product_value ?? 'Product Value') . " , " . ($cartItem->product_attribute ?? 'Product Attribute')}}</div>
                            </div>
                            <div class="line-item-detail-quantity-attribute">
                                <div class="box-quantity-fa">
    {{--                                <button class="btn-minus-plus btn-minus"><i class="fa-solid fa-minus"></i></button>--}}
                                    <input type="number" class="input-quantity" value="{{$cartItem->quantity ?? 0}}" readonly>
    {{--                                <button class="btn-minus-plus btn-plus"><i class="fa-solid fa-plus"></i></button>--}}
                                </div>
                                <button class="icon-item-delete-attribute" data-product-name="{{$productName}}"
                                        data-value-name="{{$cartItem->product_value}}" data-attribute-name="{{$cartItem->product_attribute}}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>
                            </div>
                            <div class="line-item-detail-price-attribute">
                                <span class="title-price-attribute">
                                    ¥{{ number_format(floatval($cartItem->chinese_price ?? 0), 0, ',', '.') }}
                                </span>
                                <span class="title-price-small-attribute">
                                    {{ number_format(floatval($cartItem->vietnamese_price ?? 0), 0, ',', '.') }}₫
                                </span>
                            </div>
                            <div class="line-item-detail-price-attribute">
                                <span class="title-price-attribute" style="color: #F9471B">
                                    ¥{{ number_format(floatval($cartItem->chinese_price ?? 0) * ($cartItem->quantity ?? 1), 0, ',', '.') }}
                                </span>
                                <span class="title-price-small-attribute" style="color: #F9471B">
                                    {{ number_format(floatval($cartItem->vietnamese_price ?? 0) * ($cartItem->quantity ?? 1), 0, ',', '.') }}₫
                                </span>
                            </div>
                        </div>
                    @endforeach
                    <button class="btn-delete-cart-shop" data-product-name="{{$productName}}">
                        <i class="fa-regular fa-trash-can"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="box-bottom-pay-cart custom-shadow">
            <div class="d-flex align-items-center gap-4">
                <div class="box-add-all-to-cart">
                    <input type="checkbox" id="total_sp_all select_all_bottom" class="select_all_bottom">
                    <lable for="select_all_bottom">Chọn tất cả</lable>
                </div>
                <button class="btn-delete-all-cart" data-user-id="{{\Illuminate\Support\Facades\Auth::user()->id}}">
                    <i class="fa-regular fa-trash-can" style="margin-right: 5px"></i> Xóa bỏ
                </button>
            </div>

            <div class="d-flex align-items-center justify-content-between line-all-price-pick gap-4">
                <div class="title-total-price-all-cart">
                    Tổng:
                    <span id="total-price-chinese"></span>
                    <span id="total-price-vnd">()</span>
                </div>
                <button class="btn-buy-cart btn-cart-disable">Mua Hàng</button>
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
                <form id="address-form" method="POST">
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
    <script src="{{asset('assets/js/cart.js')}}"></script>
    <script>
        var deleteAttributeURL = "{{ route('cart.delete-attribute') }}";
        var deleteProductURL = "{{ route('cart.delete-product') }}";
        var deleteCartURL = "{{ route('cart.delete-cart') }}";
        var confirmApplicationURL = "{{route('confirm-application')}}";
        var updateStatus = "{{route('cart.update-status')}}"
        var csrfToken = "{{ csrf_token() }}";
    </script>
@stop
