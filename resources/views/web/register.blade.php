<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="google-site-verification" content="googleeacc2166ce777ac3.html"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Đăng ký</title>
    <link href="{{ asset('assets/images/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/images/logo.png') }}" rel="apple-touch-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
          integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
<div class="box-header">
    <div class="header-top">
        <div class="box-content header-content header-content-top">
            <div class="header-content-item">
                <a href="{{route('home')}}">Trang chủ</a>
                <a href="">Biểu phí</a>
                <a href="">Tải công cụ đặt hàng</a>
                <a href="">1688.com</a>
                <a href="">Liên hệ</a>
                <a href="">Góp ý dịch vụ</a>
            </div>
            <div class="header-content-item">
                <a href="{{route('login')}}">Đăng nhập</a>
                <a href="{{route('register')}}">Đăng ký</a>
                <a href="">Giỏ hàng <i class="fa-solid fa-cart-shopping"></i></a>
            </div>
        </div>
    </div>
</div>
<main>
    <form method="POST" action="{{ route('submit.register') }}">
        @csrf
        <div class="box-login">
            <img src="https://id.sabomall.com/images/sabo-id-feature.svg" class="img-login">
            <div class="box-content-login">
                <div class="line-header-login">
                    <a href=""><i class="fa-solid fa-chevron-left" style="color: black;font-size: 20px"></i></a>
                    <img src="https://m.sabomall.com/img/login/logo.svg" style="margin:0 auto">
                </div>
                <p class="title-login">Đăng ký tài khoản</p>

                <!-- Username -->
                <div class="mb-3 w-100 d-flex flex-column">
                    <label class="title-big-login">Tên đăng nhập</label>
                    <input placeholder="Tên đăng nhập" class="form-register-item-input" type="text" name="username" value="{{ old('username') }}">
                    @error('username')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3 w-100 d-flex flex-column">
                    <label class="title-big-login">Email</label>
                    <input placeholder="Email" class="form-register-item-input" type="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Phone -->
                <div class="mb-3 w-100 d-flex flex-column">
                    <label class="title-big-login">Số điện thoại</label>
                    <input placeholder="Số điện thoại" class="form-register-item-input" type="text" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Full Name -->
                <div class="mb-3 w-100 d-flex flex-column">
                    <label class="title-big-login">Họ và tên</label>
                    <input placeholder="Họ và tên" class="form-register-item-input" type="text" name="full_name" value="{{ old('full_name') }}">
                    @error('full_name')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3 w-100 d-flex flex-column">
                    <label class="title-big-login">Mật khẩu</label>
                    <input placeholder="Mật khẩu" class="form-register-item-input" type="password" name="password">
                    @error('password')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="mb-3 w-100 d-flex flex-column">
                    <label class="title-big-login">Xác nhận mật khẩu</label>
                    <input placeholder="Xác nhận mật khẩu" class="form-register-item-input" type="password" name="password_confirmation">
                </div>

                <button class="btn-register">Đăng ký</button>
            </div>
        </div>
    </form>

</main><!-- End #main -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</body>

</html>
