@extends('web.index')
@section('title','Thông tin tài khoản')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content box-profile">
        <div class="menu-profile">
            <a href="#" class="menu-item-profile menu-profile-active"><i class="fa-regular fa-user"></i> Thông tin cá nhân</a>
            <a href="#" class="menu-item-profile"><i class="fa-regular fa-clipboard"></i> Quản lý đơn hàng</a>
            <a href="#" class="menu-item-profile"><i class="fa-regular fa-credit-card"></i> Tài khoản trả trước</a>
            <a href="#" class="menu-item-profile"><i class="fa-solid fa-arrow-right-from-bracket"></i> Đăng xuất</a>
        </div>
        <div class="content-profile">
            <div class="position-relative">
                <img src="{{asset('assets/images/banner_profile_user.png')}}" class="w-100">
                <div class="box-avatar">
                    <img src="{{asset('assets/images/icon-avatar-user.svg')}}" alt="">
                    <div class="camera-icon">
                        <i class="fa-solid fa-camera"></i>
                    </div>
                </div>
            </div>
            <div class="content-info-profile">
                <p class="name-user">Pikopi 01</p>
                <div class="edit-info" data-bs-toggle="modal" data-bs-target="#staticEditUser">Chỉnh sửa thông tin <i class="fa-regular fa-pen-to-square"></i></div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Tên đăng nhập:</span>
                    <span class="name-info-user">pikopi</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Email:</span>
                    <span class="name-info-user">nguyendatdz001@gmail.com</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Số điện thoại:</span>
                    <span class="name-info-user">0123456789</span>
                </div>
                <div class="line-profile"></div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Ngày sinh:</span>
                    <span class="name-info-user">16/05/2001</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <span class="title-info-user">Giới tính:</span>
                    <span class="name-info-user">Nam</span>
                </div>
            </div>

        </div>


    </div>
    <!-- Modal edit user-->
    <div class="modal fade" id="staticEditUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticEditUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 title-add-address" id="staticEditUserLabel">Chỉnh Sửa Thông Tin Cá Nhân</h1>
                    <button type="button" class="btn-close close-address" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-0">
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Họ và tên </span>
                        <input type="text" class="input-form-address" placeholder="Họ và tên" value="pikopi 01" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Tên đăng nhập</span>
                        <input type="text" class="input-form-address" placeholder="Tên đăng nhập" value="pikopi" disabled>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Email</span>
                        <input type="text" class="input-form-address" placeholder="Email" value="nguyendatdz@gmail.com" disabled>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Số điện thoại</span>
                        <input type="text" class="input-form-address" placeholder="Số điện thoại" value="012345678" disabled>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Ngày sinh</span>
                        <input type="date" class="input-form-address" placeholder="Ngày sinh" required>
                    </div>
                    <div class="w-100 d-flex flex-column mb-3">
                        <span class="title-form-address">Giới tính</span>
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center ">
                                <input type="radio" >
                                <label for="" style="font-size: 12px;margin-left: 3px">Nam</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="radio" >
                                <label for="" style="font-size: 12px;margin-left: 3px">Nữ</label>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="radio" >
                                <label for="" style="font-size: 12px;margin-left: 3px">Khác</label>
                            </div>
                        </div>
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

@stop
