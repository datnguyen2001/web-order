@extends('web.index')
@section('title','Quản lý đơn hàng')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">
        <img src="https://sabomall.com/banner_top.png" alt="" class="w-100">

        <div class="box-search-order custom-shadow">
            <p class="title-search-order">Tìm kiếm</p>
            <div class="box-input-search-order">
                <div class="d-flex flex-column gap-2">
                    <label for="" class="title-order-filter">Mã đơn hàng</label>
                    <input type="text" class="input-search-order" placeholder="Vui lòng nhập mã đơn hàng">
                </div>
                <div class="d-flex flex-column gap-2">
                    <label for="" class="title-order-filter">Ngày tạo đơn</label>
                    <input type="date" class="input-search-order" placeholder="Vui lòng nhập mã đơn hàng">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn-search-order"> <i class="fa-solid fa-magnifying-glass"></i>Tìm Kiếm</button>
            </div>
        </div>

        <div class="box-content-order custom-shadow">
            <div class="box-menu-status-order">
                <div class="menu-item-order menu-item-order-active">Tất cả</div>
                <div class="menu-item-order">Đã ký gửi</div>
                <div class="menu-item-order ">Chờ duyệt</div>
                <div class="menu-item-order">Người bán giao</div>
                <div class="menu-item-order ">Hàng về kho trung quốc</div>
                <div class="menu-item-order">Vận chuyển quốc tế</div>
                <div class="menu-item-order ">Chờ giao</div>
                <div class="menu-item-order ">Đang giao</div>
                <div class="menu-item-order">Đã nhận hàng</div>
                <div class="menu-item-order ">Đã hủy</div>
                <div class="menu-item-order">Thất lạc</div>
                <div class="menu-item-order ">Không nhận hàng</div>
            </div>
            <div class="box-content-order-wrapper">
               <div style="min-width: 600px">
                   <div class="header-status-order-wrapper">
                       <div class="header-status-order">
                           <div class="name-product-order">Sản phẩm</div>
                           <div class="name-item-order">Tiền hàng</div>
                           <div class="name-quantity-order">Số lượng</div>
                           <div class="name-money-order">Tổng tiền</div>
                           <div class="name-status-order">Trạng thái</div>
                           <div class="name-work-order">Hoạt động</div>
                       </div>
                   </div>

              <div class="box-list-order-user">

{{--                  <div class="content-item-order mb-2">--}}
{{--                      <div class="line-status-shop">--}}
{{--                          <div class="order-code">Đơn hàng <span>S85TG5</span></div>--}}
{{--                          <div class="line-date">2024-09-09 15:57:56</div>--}}
{{--                      </div>--}}
{{--                      <div class="line-content-order">--}}
{{--                          <div class="name-product-order d-flex gap-2">--}}
{{--                              <img src="https://img.alicdn.com/bao/uploaded/i3/2215220601790/O1CN01CWT1TG1P5rw3LypJ7_!!2215220601790.jpg" class="img-sp-order">--}}
{{--                              <div class="d-flex flex-column">--}}
{{--                                  <div class="name-sp-item">小米真骨传导蓝牙耳机2024年新款无线降噪运动跑步夹耳式超长待机</div>--}}
{{--                                  <div class="name-attr-product">Kích cỡ: <span>Cỡ 36-37 (phù hợp với chân 35-36)</span></div>--}}
{{--                              </div>--}}
{{--                          </div>--}}
{{--                          <div class="name-item-order d-flex flex-column align-items-end">--}}
{{--                              <div class="price-cq">¥78,00</div>--}}
{{--                              <div class="price-vn">284.310₫</div>--}}
{{--                          </div>--}}
{{--                          <div class="name-quantity-order price-cq">2</div>--}}
{{--                          <div class="name-money-order d-flex flex-column align-items-end">--}}
{{--                              <div class="price-cq">¥78,00</div>--}}
{{--                              <div class="price-vn">284.310₫</div>--}}
{{--                          </div>--}}
{{--                          <div class="name-status-order d-flex flex-column align-items-center">--}}
{{--                              <div class="status-order">Chờ đặt cọc</div>--}}
{{--                              <a href="#" class="link-detail-order">Chi tiết</a>--}}
{{--                          </div>--}}
{{--                          <div class="name-work-order d-flex flex-column align-items-center">--}}
{{--                              <a href="#" class="status-order-pay">Hủy đơn</a>--}}
{{--                          </div>--}}
{{--                      </div>--}}

{{--                  </div>--}}

              </div>

               </div>
            </div>

        </div>

    </div>


@stop
@section('script_page')
    <script src="{{asset('assets/js/detail-order.js')}}"></script>
@stop
