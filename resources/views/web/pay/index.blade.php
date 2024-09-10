@extends('web.index')
@section('title','Xác nhận đơn')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/pay.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

       <div class="box-shipping-unit shadow-lg">
           <p class="title-shipping-unit">Vận chuyển Trung Quốc - Việt Nam</p>
           <div class="d-flex align-items-center mb-2">
               <div class="d-flex align-items-center">
                   <input type="radio" style="margin-right: 7px">
                   <label class="title-unit">Qua đối tác do SaboMall chỉ định</label>
               </div>
               <div class="d-flex align-items-center" style="margin-left: 20px">
                   <input type="radio" style="margin-right: 7px">
                   <label class="title-unit">Tự chọn đơn vị vận chuyển</label>
               </div>
           </div>
           <div class="w-100 d-flex align-items-center">
               <span class="title-delivered">Giao đến: </span>
               <i class="fa-solid fa-truck" style="color: #0f5132;font-size: 16px;margin-right: 8px"></i>
               <div class="d-flex align-items-center text-detail-address">
                   <b>hapiko</b>
                   <span>q2123123, Phường Phú Diễn, Quận Bắc Từ Liêm, Thành phố Hà Nội, 078456626266</span>
               </div>
               <div class="text-change" data-bs-toggle="modal" data-bs-target="#staticBackdropSelectAddress">Thay đổi</div>
           </div>
       </div>

        @for($a=0;$a<2;$a++)
        <div class="box-order-item shadow-lg">
            <div class="item-order-left">
                <p class="title-order-number">Đơn hàng 1</p>
                <div class="line-title-shop">
                    <img src="https://sabomall.com/cart/icon_1688.png" style="width: 56px">
                    <a href="">
                        义乌市涵许电子商务商行 <span>(Công ty thương mại điện tử Hanxu thành phố Nghĩa Ô)</span>
                    </a>
                </div>
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
            </div>
        </div>
            @endfor

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
                        <div class="address-card selected" onclick="selectAddress(this)">
                            <div class="address-info">
                                <span class="radio-btn selected"></span>
                                <div class="detail-name-address">
                                    <strong>Nguyễn</strong> (+84123121231)<br>
                                    123, Phường 01, Quận 10, Thành phố Hồ Chí Minh
                                    <br>
                                    <span class="default-tag">Mặc định</span>
                                </div>
                            </div>
                            <a class="update-link" data-bs-toggle="modal" data-bs-target="#staticBackdropAddress">Cập Nhật</a>
                        </div>
                        <div class="address-card" onclick="selectAddress(this)">
                            <div class="address-info">
                                <span class="radio-btn"></span>
                                <div class="detail-name-address">
                                    <strong>hapiko</strong> (0978129116)<br>
                                    q2123123, Phường Phú Diễn, Quận Bắc Từ Liêm, Thành phố Hà Nội
                                </div>
                            </div>
                            <a class="update-link" data-bs-toggle="modal" data-bs-target="#staticBackdropAddress">Cập Nhật</a>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 d-flex justify-content-between flex-wrap align-items-center">
                    <button class="btn-plus-address"><i class="fa-solid fa-plus"></i> Thêm Mới Địa Chỉ</button>
                   <div class="d-flex align-items-center gap-2">
                       <button type="button" class="btn btn-secondary btn-dismiss-address" data-bs-dismiss="modal">Hủy Bỏ</button>
                       <button type="button" class="btn btn-primary btn-success-address">Xác Nhận</button>
                   </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal add address-->
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
    <script>
        function selectAddress(element) {
            document.querySelectorAll('.address-card').forEach(card => {
                card.classList.remove('selected');
                card.querySelector('.radio-btn').classList.remove('selected');
            });
            element.classList.add('selected');
            element.querySelector('.radio-btn').classList.add('selected');
        }
    </script>
@stop
