@extends('web.index')
@section('title','Trang chủ')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/home.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <div class="menu-banner-info">
            <div class="menu custom-shadow">
                <div class="d-flex align-center gap-3">
                    <i class="fa-solid fa-bars d-flex align-items-center"></i>
                    <span class="title-menu">Danh mục</span>
                </div>
                <div class="box-category position-relative">
                    @foreach($category as $cate)
                        <div class="category-wrapper">
                        <a href="" class="d-flex align-center gap-3 py-1">
{{--                            <img src="{{asset('assets/images/Thoi_trang.png')}}" alt="" class="img-category">--}}
                            <span class="item-category">{{$cate->name}}</span>
                        </a>
                        <div class="sub-category">
                            @foreach($cate->category_sub_2 as $cate2)
                            <a href="" class="title-big-category">{{$cate2->name}}</a>
                            <div class="d-flex align-items-center flex-wrap mb-2">
                                @foreach($cate2->category_sub_3 as $cate3)
                                <a href="#" class="title-small-category">{{$cate3->name}}</a>
                                @endforeach
                            </div>
                                @endforeach
                        </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-banner">
                <div class="list-banner custom-shadow w-100">
                    <div class="swiper bannerSwiper">
                        <div class="swiper-wrapper">
                            @foreach($banner as $banners)
                                <div class="swiper-slide"><a @if($banners->link) href="{{$banners->link}}" @endif>
                                        <img src="{{$banners->src}}" class="w-100" style="object-fit: cover">
                                    </a></div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class=" bg-white box-distributor d-flex gap-5 align-items-center">
                    <div class="swiper distributorSwiper">
                        <div class="swiper-wrapper">
                            @foreach($eCommerce as $eCommerces)
                                <div class="swiper-slide">
                                    <a @if($eCommerces->link) href="{{$eCommerces->link}}" @endif class="d-flex flex-column align-center justify-content-center">
                                        <img
                                            src="{{asset($eCommerces->src)}}"
                                            alt="" class="img-distributor">
                                        <span class="title-distributor">{{@$eCommerces->name}}</span>
                                    </a></div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next next-distributor"></div>
                        <div class="swiper-button-prev prev-distributor"></div>
                    </div>
                </div>
            </div>
            <div class="box-info">
                <div class="bg-white info-top p-3 custom-shadow ">
                    <div class="d-flex gap-3 align-items-center">
                        <img src="{{asset('assets/images/icon-avatar-signup.svg')}}" alt="">
                        @if(!\Illuminate\Support\Facades\Auth::check())
                            <span class="title-info-top">Đăng nhập ngay để bắt đầu mua sắm!!!</span>
                            @else
                            <div class="d-flex flex-column">
                                <div class="title-hello">Xin chào <span>{{\Illuminate\Support\Facades\Auth::user()->full_name}}</span></div>
                                <div class="text-tg">
                                    <span>Tỷ giá hôm nay:</span>
                                    <span style="color: rgb(249,71,27,1);margin-left: 5px">¥1 = {{number_format(@$setting->exchange_rate)}}₫</span>
                                </div>
                            </div>

                        @endif
                    </div>
                    <div class="ant-divider my-3"></div>
                    @if(!\Illuminate\Support\Facades\Auth::check())
                    <div class="text-tg">
                        <span>Tỷ giá hôm nay:</span>
                        <span style="color: rgb(249,71,27,1);margin-left: 5px">¥1 = {{number_format(@$setting->exchange_rate)}}₫</span>
                    </div>
                        @else
                        <div class="d-flex flex-column gap-2">
                            <div class="title-hello">Tài khoản trả trước:</div>
                            <div class="d-flex align-items-center gap-4">
                                <div class="d-flex align-items-center gap-2"> <span class="unit-price">đ</span> <span class="price-wallet">{{number_format($wallet->vietnamese_money)}}đ</span></div>
                                <div class="d-flex align-items-center gap-2"> <span class="unit-price-2">¥</span> <span class="price-wallet">¥{{number_format($wallet->middle_money)}}</span></div>
                            </div>
                        </div>
                    @endif
                    @if(!\Illuminate\Support\Facades\Auth::check())
                    <div class="w-100 box-btn">
                        <a href="{{route('login')}}" class="btn-link-dn">Đăng nhập</a>
                        <a href="{{route('register')}}" class="btn-link-dk">Đăng ký</a>
                    </div>
                        @endif
                </div>
                <div class="info-bottom custom-shadow p-3 bg-white">
                    <span style="color:  rgb(26 26 26 / 1);font-size: .785rem;font-weight: 600">Về SaboMall</span>
                    <div class="content-info-shop custom-content-4-line">{!! @$setting->about_shop !!}
                    </div>
                    <a href="{{route('about')}}" class="link-more-info">Xem thêm về chúng tôi <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>

        <img src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/Frame_1000003523_9405c7e9ba.png" alt=""
             class="img-banner-home">

        <div class="box-list-content">
            <div class="line-home-title">
                <div class="title-big-deal">SABO DEAL</div>
                <a href="" class="link-more-deal">Xem thêm <i class="fa-solid fa-chevron-right"
                                                              style="padding-left: 7px"></i></a>
            </div>
            <div class="box-slide-product">
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @for($i=0;$i<10;$i++)
                            <div class="swiper-slide">
                                <a class="box-product-item">
                                    <div class="w-100 position-relative">
                                        <img
                                            src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/O1_CN_01_Mm2_U2d1d1_CV_4ce9_EL_2217660303675_0_cib_d2fd824122.jpg"
                                            class="w-100" style="object-fit: cover">
                                        <div class="box-super-cheap">
                                            <img src="https://sabomall.com/tag.png" alt="" class="icon-cheap">
                                            SIÊU RẺ
                                        </div>
                                    </div>
                                    <div class="content-item-sp">
                                        <div class="title-product-item custom-content-2-line">
                                            <img src="https://m.sabomall.com/icons/icon-1688-tag.svg" alt="">
                                            Ly giữ nhiệt bằng thép không gỉ 304 xuất khẩu, ly cà phê Mỹ đá đẹp mắt, cốc cầm
                                            tay có ống hút
                                            tiện lợi
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big-red">¥25,90</div>
                                            <div class="text-price-red">¥44,60</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big">¥25,90</div>
                                            <div class="text-price-small">¥44,60</div>
                                        </div>
                                        <div class="title-sold">Đã bán 4.2k sản phẩm</div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-button-next next-distributor"></div>
                    <div class="swiper-button-prev prev-distributor"></div>
                </div>
            </div>
        </div>

        <div class="box-list-content">
            <div class="line-home-title">
                <div class="title-big-shop">SABO SHOP</div>
                <a href="" class="link-more-deal">Xem thêm <i class="fa-solid fa-chevron-right"
                                                              style="padding-left: 7px"></i></a>
            </div>
            <div class="box-slide-product">
                <div class="swiper productShopSwiper">
                    <div class="swiper-wrapper">
                        @for($i=0;$i<10;$i++)
                            <div class="swiper-slide">
                                <a class="box-product-shop-item">
                                    <div class="w-100 img-product-shop-item">
                                        <img
                                            src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/O1_CN_016fra_Fd1_Bs2x5q_Lfeb_0_0_cib_21564e9472.jpg"
                                            class="w-100" style="object-fit: cover">
                                    </div>
                                    <div class="title-product-shop-item custom-content-2-line">
                                        Công Ty TNHH Công Nghiệp Bàn Chải Dương Châu
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-button-next next-distributor"></div>
                    <div class="swiper-button-prev prev-distributor"></div>
                </div>
            </div>
        </div>

        <div class="box-list-content">
            <div class="line-home-title line-bottom-chkd">
                <div class="title-big-shop"> Cơ Hội Kinh Doanh Từ 1688</div>
                <div class="d-flex align-items-center box-line-menu-chkd-desktop">
                    <div class="tab-menu-category active" data-index="0">Sản phẩm mới nổi 1688</div>
                    <div class="tab-menu-category" data-index="1">Sản phẩm hot 1688</div>
                    <div class="tab-menu-category" data-index="2">Sản phẩm gợi ý 1688</div>
                </div>
                <a href="" class="link-more-deal">Xem thêm <i class="fa-solid fa-chevron-right"
                                                              style="padding-left: 7px"></i></a>
            </div>
            <div class="d-flex align-items-center box-line-menu-chkd-mobile">
                <div class="tab-menu-category active" data-index="0">Sản phẩm mới nổi 1688</div>
                <div class="tab-menu-category" data-index="1">Sản phẩm hot 1688</div>
                <div class="tab-menu-category" data-index="2">Sản phẩm gợi ý 1688</div>
            </div>
            <div class="box-slide-product box-tab-menu-product" data-index="0">
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @for($i=0;$i<10;$i++)
                            <div class="swiper-slide">
                                <a class="box-product-item">
                                    <div class="w-100 position-relative">
                                        <img
                                            src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/O1_CN_01_Mm2_U2d1d1_CV_4ce9_EL_2217660303675_0_cib_d2fd824122.jpg"
                                            class="w-100" style="object-fit: cover">
                                        <div class="box-super-top">
                                            {{$i+1}}
                                        </div>
                                    </div>
                                    <div class="content-item-sp">
                                        <div class="title-product-item custom-content-2-line">
                                            <img src="https://m.sabomall.com/icons/icon-1688-tag.svg" alt="">
                                            Ly giữ nhiệt bằng thép không gỉ 304 xuất khẩu, ly cà phê Mỹ đá đẹp mắt, cốc cầm
                                            tay có ống hút
                                            tiện lợi
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big-red">¥25,90</div>
                                            <div class="text-price-red">¥44,60</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big">¥25,90</div>
                                            <div class="text-price-small">¥44,60</div>
                                        </div>
                                        <div class="title-sold">Đã bán 4.2k sản phẩm</div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-button-next next-distributor"></div>
                    <div class="swiper-button-prev prev-distributor"></div>
                </div>
            </div>
            <div class="box-slide-product box-tab-menu-product" data-index="1">
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @for($i=0;$i<10;$i++)
                            <div class="swiper-slide">
                                <a class="box-product-item">
                                    <div class="w-100 position-relative">
                                        <img
                                            src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/O1_CN_01_Mm2_U2d1d1_CV_4ce9_EL_2217660303675_0_cib_d2fd824122.jpg"
                                            class="w-100" style="object-fit: cover">
                                        <div class="box-super-top">
                                            {{$i+1}}
                                        </div>
                                    </div>
                                    <div class="content-item-sp">
                                        <div class="title-product-item custom-content-2-line">
                                            <img src="https://m.sabomall.com/icons/icon-1688-tag.svg" alt="">
                                            Ly giữ nhiệt bằng thép không gỉ 304 xuất khẩu, ly cà phê Mỹ đá đẹp mắt, cốc cầm
                                            tay có ống hút
                                            tiện lợi
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big-red">¥25,90</div>
                                            <div class="text-price-red">¥44,60</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big">¥25,90</div>
                                            <div class="text-price-small">¥44,60</div>
                                        </div>
                                        <div class="title-sold">Đã bán 4.2k sản phẩm</div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-button-next next-distributor"></div>
                    <div class="swiper-button-prev prev-distributor"></div>
                </div>
            </div>
            <div class="box-slide-product box-tab-menu-product" data-index="2">
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @for($i=0;$i<10;$i++)
                            <div class="swiper-slide">
                                <a class="box-product-item">
                                    <div class="w-100 position-relative">
                                        <img
                                            src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/O1_CN_01_Mm2_U2d1d1_CV_4ce9_EL_2217660303675_0_cib_d2fd824122.jpg"
                                            class="w-100" style="object-fit: cover">
                                        <div class="box-super-top">
                                            {{$i+1}}
                                        </div>
                                    </div>
                                    <div class="content-item-sp">
                                        <div class="title-product-item custom-content-2-line">
                                            <img src="https://m.sabomall.com/icons/icon-1688-tag.svg" alt="">
                                            Ly giữ nhiệt bằng thép không gỉ 304 xuất khẩu, ly cà phê Mỹ đá đẹp mắt, cốc cầm
                                            tay có ống hút
                                            tiện lợi
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big-red">¥25,90</div>
                                            <div class="text-price-red">¥44,60</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big">¥25,90</div>
                                            <div class="text-price-small">¥44,60</div>
                                        </div>
                                        <div class="title-sold">Đã bán 4.2k sản phẩm</div>
                                    </div>
                                </a>
                            </div>
                        @endfor
                    </div>
                    <div class="swiper-button-next next-distributor"></div>
                    <div class="swiper-button-prev prev-distributor"></div>
                </div>
            </div>
        </div>

        <div class="box-list-content">
            <div class="line-home-title">
                <div class="title-big-shop">Đề xuất cho bạn</div>
                <a href="" class="link-more-deal">Xem thêm <i class="fa-solid fa-chevron-right"
                                                              style="padding-left: 7px"></i></a>
            </div>
            <div class="content-recommended">
                @for($i=0;$i<18;$i++)
                    <a class="box-product-item">
                        <div class="w-100 position-relative">
                            <img
                                src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/O1_CN_01_Mm2_U2d1d1_CV_4ce9_EL_2217660303675_0_cib_d2fd824122.jpg"
                                class="w-100" style="object-fit: cover">
                        </div>
                        <div class="content-item-sp">
                            <div class="title-product-item custom-content-2-line">
                                <img src="https://m.sabomall.com/icons/icon-1688-tag.svg" alt="">
                                Ly giữ nhiệt bằng thép không gỉ 304 xuất khẩu, ly cà phê Mỹ đá đẹp mắt, cốc cầm
                                tay có ống hút
                                tiện lợi
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="text-price-big-red">¥25,90</div>
                                <div class="text-price-red">¥44,60</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="text-price-big">¥25,90</div>
                                <div class="text-price-small">¥44,60</div>
                            </div>
                            <div class="title-sold">Đã bán 4.2k sản phẩm</div>
                        </div>
                    </a>
                    @endfor
            </div>
        </div>

    </div>

@stop
@section('script_page')
    <script src="{{asset('assets/js/home.js')}}"></script>
@stop
