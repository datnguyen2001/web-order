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
                    @for($i=0;$i<10;$i++)
                        <div class="category-wrapper">
                        <a href="" class="d-flex align-center gap-3 py-1">
                            <img src="{{asset('assets/images/Thoi_trang.png')}}" alt="" class="img-category">
                            <span class="item-category">Thời Trang</span>
                        </a>
                        <div class="sub-category">
                            <a href="" class="title-big-category">Thời trang nữ</a>
                            <div class="d-flex align-items-center flex-wrap mb-2">
                                <a href="#" class="title-small-category">Váy</a>
                                <a href="#" class="title-small-category">Váy</a>
                            </div>
                        </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="box-banner">
                <div class="list-banner custom-shadow w-100">
                    <div class="swiper bannerSwiper">
                        <div class="swiper-wrapper">
                            @for($i=0;$i<5;$i++)
                                <div class="swiper-slide"><img
                                        src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/600x250_8_2d1302e753.jpg"
                                        alt=""></div>
                            @endfor
                        </div>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
                <div class=" bg-white box-distributor d-flex gap-5 align-items-center">
                    <div class="swiper distributorSwiper">
                        <div class="swiper-wrapper">
                            @for($i=0;$i<10;$i++)
                                <div class="swiper-slide">
                                    <a href="#" class="d-flex flex-column align-center justify-content-center">
                                        <img
                                            src="https://sabomall-chapi-dream.s3.ap-southeast-1.amazonaws.com/O1_CN_01_M4w_D_Lz1plhv_D5_Di_AV_6000000005401_2_tps_96_96_4321bc7aa6.png"
                                            alt="" class="img-distributor">
                                        <span class="title-distributor">Sabo học viện</span>
                                    </a></div>
                            @endfor
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
                        <span class="title-info-top">Đăng nhập ngay để bắt đầu mua sắm!!!</span>
                    </div>
                    <div class="ant-divider my-3"></div>
                    <div class="text-tg">
                        <span>Tỷ giá hôm nay:</span>
                        <span style="color: rgb(249,71,27,1);margin-left: 5px">¥1 = 3.645₫</span>
                    </div>
                    <div class="w-100 box-btn">
                        <a href="" class="btn-link-dn">Đăng nhập</a>
                        <a href="" class="btn-link-dk">Đăng ký</a>
                    </div>
                </div>
                <div class="info-bottom custom-shadow p-3 bg-white">
                    <span style="color:  rgb(26 26 26 / 1);font-size: .785rem;font-weight: 600">Về SaboMall</span>
                    <div class="content-info-shop">SaboMall là đối tác chính thức của 1688.com tại Việt Nam. Cùng
                        1688.com, chúng tôi giúp bạn tìm kiếm những nguồn hàng chất lượng cao và mang đến trải nghiệm
                        mua sắm, thanh toán thuận tiện, an toàn, nhanh chóng.
                    </div>
                    <a href="#" class="link-more-info">Xem thêm về chúng tôi <i class="fa-solid fa-arrow-right"></i></a>
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
