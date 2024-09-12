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
                <div class="menu-item-order menu-item-order-active">Chưa đặt cọc <span>(6)</span></div>
                <div class="menu-item-order">Chờ shop giao</div>
                <div class="menu-item-order ">Vận chuyển quốc tế</div>
                <div class="menu-item-order">Đã giao</div>
                <div class="menu-item-order ">Đã nhận hàng</div>
                <div class="menu-item-order">Đã hoàn tiền</div>
                <div class="menu-item-order ">Hủy bỏ</div>
            </div>
            <div class="box-content-order-wrapper">
               <div style="min-width: 600px">
                   <div class="header-status-order-wrapper">
                       <div class="header-status-order">
                           <div class="name-product-order">Sản phẩm</div>
                           <div class="name-item-order">Tên hàng</div>
                           <div class="name-quantity-order">Số lượng</div>
                           <div class="name-money-order">Tổng tiền</div>
                           <div class="name-status-order">Trạng thái</div>
                           <div class="name-work-order">Hoạt động</div>
                       </div>
                   </div>

                   @for($i=0;$i<2;$i++)
                       <div class="content-item-order mb-2">
                           <div class="line-status-shop">
                               <div class="order-code">Đơn hàng <span>S85TG5</span></div>
                               <div class="line-date">2024-09-09 15:57:56</div>
                               <img src="https://sabomall.com/cart/icon_taobao.png" alt="" style="width: 60px;border-radius: 4px">
                               <div class="name-shop">XIAOMI优选小店(Cửa hàng nhỏ ưa thích XIAOMI)</div>
                           </div>
                           <div class="line-content-order">
                               <div class="name-product-order d-flex gap-2">
                                   <img src="https://img.alicdn.com/bao/uploaded/i3/2215220601790/O1CN01CWT1TG1P5rw3LypJ7_!!2215220601790.jpg" class="img-sp-order">
                                   <div class="d-flex flex-column">
                                       <div class="name-sp-item">小米真骨传导蓝牙耳机2024年新款无线降噪运动跑步夹耳式超长待机</div>
                                       <div class="name-attr-product">Kích cỡ: <span>Cỡ 36-37 (phù hợp với chân 35-36)</span></div>
                                   </div>
                               </div>
                               <div class="name-item-order d-flex flex-column align-items-end">
                                   <div class="price-cq">¥78,00</div>
                                   <div class="price-vn">284.310₫</div>
                               </div>
                               <div class="name-quantity-order price-cq">2</div>
                               <div class="name-money-order d-flex flex-column align-items-end">
                                   <div class="price-cq">¥78,00</div>
                                   <div class="price-vn">284.310₫</div>
                               </div>
                               <div class="name-status-order d-flex flex-column align-items-center">
                                   <div class="status-order">Chờ đặt cọc</div>
                                   <a href="#" class="link-detail-order">Chi tiết</a>
                               </div>
                               <div class="name-work-order d-flex flex-column align-items-center">
                                   <a href="#" class="status-order-pay">Chờ đặt cọc</a>
                                   <a href="#" class="status-order-cancel">Hủy đơn</a>
                               </div>
                           </div>

                       </div>
                   @endfor
               </div>
            </div>

        </div>

    </div>


@stop
@section('script_page')

@stop
