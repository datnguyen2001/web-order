<div class="box-header">
    <div class="header-top">
        <div class="box-content header-content header-content-top">
            <div class="header-content-item">
                <a href="">Trang chủ</a>
                <a href="">Biểu phí</a>
                <a href="">Tải công cụ đặt hàng</a>
                <a href="">1688.com</a>
                <a href="">Liên hệ</a>
                <a href="">Góp ý dịch vụ</a>
            </div>
            <div class="header-content-item">
                <a href="{{route('login')}}">Đăng nhập</a>
                <a href="{{route('register')}}">Đăng ký</a>
                <a href="" class="position-relative">Giỏ hàng <i class="fa-solid fa-cart-shopping"></i> <div class="circle-cart">2</div></a>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="box-content header-content header-content-bottom">
            <a href="#">
                <img src="{{asset('assets/images/logo_new.png')}}" alt="" class="img-logo">
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
    <a href="#" class="link-logo-page">
        <img src="{{asset('assets/images/logo_new.png')}}" alt="" class="img-logo">
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
            @for($i=0;$i<5;$i++)
            <div class="accordion-item">
                <h2 class="accordion-header" id="heading_{{$i}}">
                    <button class="accordion-button accordion-menu " type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{$i}}" aria-expanded="false" aria-controls="collapse_{{$i}}">
                        <a href="" class="d-flex align-center gap-3 py-1">
                            <img src="{{asset('assets/images/Thoi_trang.png')}}" alt="" class="img-category">
                            <span class="item-category">Thời Trang</span>
                        </a>
                    </button>
                </h2>
                <div id="collapse_{{$i}}" class="accordion-collapse collapse" aria-labelledby="heading_{{$i}}" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <a href="" class="title-big-category">Thời trang nữ</a>
                        <div class="d-flex align-items-center flex-wrap mb-2">
                            <a href="#" class="title-small-category">Váy</a>
                            <a href="#" class="title-small-category">Váy</a>
                        </div>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>
</div>
