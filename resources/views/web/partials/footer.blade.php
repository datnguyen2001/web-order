<div class="box-footer">
    <div class="box-content footer-content">
        <div class="d-flex justify-content-between flex-wrap">
            <div class="content-footer-left">
                <div class="d-flex flex-column">
                    <p class="title-footer">Chăm sóc khách hàng</p>
                    @foreach($post1 as $post1s)
                    <a href="{{route('post',$post1s->slug)}}" class="content-footer-item">{{$post1s->name}}</a>
                    @endforeach
                </div>
                <div class="d-flex flex-column">
                    <p class="title-footer">Về SaboMall</p>
                    <a href="{{route('about')}}" class="content-footer-item">Giới thiệu về SaboMall</a>
                    @foreach($post2 as $post2s)
                    <a href="{{route('post',$post2s->slug)}}" class="content-footer-item">{{$post2s->name}}</a>
                    @endforeach
                </div>
                <div class="d-flex flex-column">
                    <p class="title-footer">Theo dõi chúng tôi tại</p>
                    <div class="d-flex align-items-center">
                        <a href="{{@$setting->facebook}}" target="_blank" class="content-footer-item"><img src="{{asset('assets/images/icon_fb.png')}}" class="icon-media"></a>
                        <a href="{{@$setting->tiktok}}" target="_blank" class="content-footer-item"><img src="{{asset('assets/images/icon_tt.png')}}" class="icon-media"></a>
                        <a href="{{@$setting->youtube}}" target="_blank" class="content-footer-item"><img src="{{asset('assets/images/icon_yt.png')}}" class="icon-media"></a>
                    </div>
                </div>
            </div>
            <div class="content-footer-right">
                    <div class="d-flex flex-column align-items-center">
                        <img src="{{asset(@$setting->img_qr)}}" class="img-qr">
                        <p class="title-dowload-qr">Tải ứng dụng SaboMall</p>
                    </div>
            </div>
        </div>
        <div class="d-flex mt-3 box-footer-bottom">
            <div>
                <p class="title-footer">SABOMALL - ĐỐI TÁC CHÍNH THỨC CỦA 1688.COM TẠI VIỆT NAM</p>
                <div class="content-footer-item mb-1">{!! @$setting->content_footer_one !!}</div>
            </div>
            <div class="line-logo-footer">
                <p class="title-footer">Bản quyền thuộc công ty Sabo Technology Pte. Ltd.</p>
                <div class="content-footer-item mb-1">{!! @$setting->content_footer_two !!}</div>
                <img src="{{asset(@$setting->logo)}}" alt="" style="width: 200px;margin-top: 20px">
            </div>
        </div>
    </div>
</div>

<div class="box-footer-mobile custom-shadow">
    <a href="{{route('home')}}" class="item-menu-footer">
        <img src="https://m.sabomall.com/favicon.ico" class="icon-menu-footer">
        <span class="active-menu-footer">Trang chủ</span>
    </a>
    <a href="{{route('cart')}}" class="item-menu-footer">
        <i class="fa-solid fa-cart-shopping icon-menu-footer"></i>
        <span>Giỏ hàng</span>
    </a>
    <a href="#" class="item-menu-footer">
        <i class="fa-regular fa-bell icon-menu-footer"></i>
        <span>Thông báo</span>
    </a>
    <a href="#" class="item-menu-footer">
        <i class="fa-solid fa-store icon-menu-footer"></i>
        <span>Đơn hàng</span>
    </a>
    <a href="{{route('profile')}}" class="item-menu-footer">
        <i class="fa-regular fa-user icon-menu-footer"></i>
        <span>Tài khoản</span>
    </a>
</div>
