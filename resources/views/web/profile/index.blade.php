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
                <div class="edit-info">Chỉnh sửa thông tin <i class="fa-regular fa-pen-to-square"></i></div>
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


@stop
@section('script_page')

@stop
