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
                @if(!\Illuminate\Support\Facades\Auth::check())
                <a href="{{route('login')}}">Đăng nhập</a>
                <a href="{{route('register')}}">Đăng ký</a>
                    @else
                    <div class="dropdown">
                        <a data-bs-toggle="dropdown" aria-expanded="false" style="display: inline-block;padding-bottom: 3px">
                            {{\Illuminate\Support\Facades\Auth::user()->full_name}} <i class="fa-solid fa-angle-down" style="color:#F9471B;"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('profile')}}"><i class="fa-regular fa-user" style="padding-right: 5px"></i> Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="{{route('order')}}"><i class="fa-regular fa-clipboard" style="padding-right: 5px"></i> Quản lý đơn hàng</a></li>
                            <li><a class="dropdown-item" href="{{url('lich-su-giao-dich/vi')}}"><i class="fa-regular fa-credit-card" style="padding-right: 5px"></i> Tài khoản trả trước</a></li>
                            <li><a class="dropdown-item" href="{{route('logout')}}"><i class="fa-solid fa-arrow-right-from-bracket" style="padding-right: 5px"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                @endif
                <a href="{{route('cart')}}" class="position-relative">Giỏ hàng <i class="fa-solid fa-cart-shopping"></i> <div class="circle-cart">{{$countCartItem}}</div></a>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="box-content header-content header-content-bottom">
            <a href="{{route('home')}}">
                <img src="{{asset(@$setting->logo)}}" alt="" class="img-logo">
            </a>
            <div class="content-bottom-header">
                <div class="box-search">
                    <div class="box-input-search">
                        <input type="text" class="input-search-header" placeholder="Nhập từ khoá hoặc link sản phẩm trên 1688 để tìm kiếm">
                    </div>
                    <div class="box-btn-search">
                        <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                        <div class="title-btn-search">
                            Tìm kiếm
                        </div>
                    </div>
                </div>
                <div class="search-camera">
                    <i class="fa-solid fa-camera"></i>
                    <div>Tìm bằng ảnh</div>
                </div>
            </div>
            <a href="">
                <img src="{{asset('assets/images/extension.png')}}" alt="" class="img-extension">
            </a>
        </div>
    </div>
</div>

<div class="box-header-mobile">
    <a href="{{route('home')}}" class="link-logo-page">
        <img src="{{asset(@$setting->logo)}}" alt="" class="img-logo">
    </a>
    <div class="content-bottom-header">
        <div class="box-search">
            <div class="box-input-search">
                <input type="text" class="input-search-header" placeholder="Nhập từ khoá hoặc link sản phẩm trên 1688 để tìm kiếm">
            </div>
            <div class="box-btn-search">
                <i class="fa-solid fa-magnifying-glass" style="color: white"></i>
                <div class="title-btn-search">
                    Tìm kiếm
                </div>
            </div>
        </div>
        <div class="search-camera">
            <i class="fa-solid fa-camera"></i>
        </div>
    </div>
    <button class="btn-menu-mobile" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasMenu" aria-controls="offcanvasMenu"><i class="fa-solid fa-bars"></i></button>
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasMenu" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title title-menu-mobile" id="offcanvasRightLabel">Danh mục</h5>
        <button type="button" class="btn-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="offcanvas-body pt-0">
        <div class="accordion" id="accordionExample">
            @foreach($category as $index => $cate)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_{{$index}}">
                    <button class="accordion-button accordion-menu" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$index}}" aria-expanded="false" aria-controls="collapse_{{$index}}">
                        <a href="{{route('category',$cate->slug)}}" class="d-flex align-center gap-3 py-1">
{{--                            <img src="{{asset('assets/images/Thoi_trang.png')}}" alt="" class="img-category">--}}
                            <span class="item-category" style="color: black">{{$cate->name}}</span>
                        </a>
                    </button>
                </h2>
                <div id="collapse_{{$index}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$index}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        @foreach($cate->children as $cate2)
                        <a href="{{url('danh-muc/'.$cate->slug.'/'.$cate2->slug)}}" class="title-big-category" style="font-weight: 600;color: #1a1a1a">{{$cate2->name}}</a>
                        <div class="d-flex align-items-center flex-wrap mb-2 gap-2">
                            @foreach($cate2->grandchildren as $cate3)
                            <a href="{{url('danh-muc/'.$cate->slug.'/'.$cate2->slug.'/'.$cate3->slug)}}" class="title-small-category">{{$cate3->name}}</a>
                            @endforeach
                        </div>
                            @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
