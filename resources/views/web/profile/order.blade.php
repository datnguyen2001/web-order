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
                    <input type="text" class="input-search-order" id="orderCode" placeholder="Vui lòng nhập mã đơn hàng">
                </div>
                <div class="d-flex flex-column gap-2">
                    <label for="" class="title-order-filter">Ngày tạo đơn</label>
                    <input type="date" class="input-search-order" id="orderDate" placeholder="Vui lòng nhập mã đơn hàng">
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button class="btn-search-order"> <i class="fa-solid fa-magnifying-glass"></i>Tìm Kiếm</button>
            </div>
        </div>

        <div class="box-content-order custom-shadow">
            <div class="box-menu-status-order">
                <div class="menu-item-order item-order-all menu-item-order-active" data-status="all">Tất cả</div>
                <div class="menu-item-order" data-status="1">Đã ký gửi</div>
                <div class="menu-item-order" data-status="2">Chờ duyệt</div>
                <div class="menu-item-order" data-status="3">Người bán giao</div>
                <div class="menu-item-order" data-status="4">Hàng về kho trung quốc</div>
                <div class="menu-item-order" data-status="5">Vận chuyển quốc tế</div>
                <div class="menu-item-order" data-status="6">Chờ giao</div>
                <div class="menu-item-order" data-status="7">Đang giao</div>
                <div class="menu-item-order" data-status="8">Đã nhận hàng</div>
                <div class="menu-item-order" data-status="9">Đã hủy</div>
                <div class="menu-item-order" data-status="10">Thất lạc</div>
                <div class="menu-item-order" data-status="11">Không nhận hàng</div>
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

              </div>

               </div>
            </div>

        </div>

    </div>


@stop
@section('script_page')
    <script src="{{asset('assets/js/detail-order.js')}}"></script>
@stop
