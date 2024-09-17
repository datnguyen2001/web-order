@extends('web.index')
@section('title','Chi tiết sản phẩm')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/product.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="w-100 bg-white">
        <div class="box-content-detail-sp">
            <div class="box-img-detail">
                <div class="swiper mySwiper2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-3.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-4.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-5.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-6.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-7.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-8.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-9.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-10.jpg" class="img-detail-sp"/>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="swiper mySwiper mt-2">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-3.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-4.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-5.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-6.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-7.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-8.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-9.jpg" class="img-detail-sp"/>
                        </div>
                        <div class="swiper-slide">
                            <img src="https://swiperjs.com/demos/images/nature-10.jpg" class="img-detail-sp"/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-content-detail">
                <p class="name-detail-sp">[Vườn thân mật] Anime Tôi là anh trai của tôi, Masaji Ito, triển lãm truyện tranh, Trang Phục cosplay Halloween, nam</p>
                <img src="https://sabomall.com/banner_top_3.png" class="w-100">
                <div class="box-price-detail">
                        <div class="d-flex mb-1">
                            <span class="title-price-detail">Giá gốc</span>
                            <span class="price-detail-big">¥68,00 - ¥90,00</span>
                        </div>
                    <div class="d-flex mb-2">
                        <span class="title-price-detail">Giá VNĐ</span>
                        <span class="price-detail-small">247.860₫ - 328.050₫</span>
                    </div>
                    <div class="d-flex">
                        <span class="title-price-detail">Số lượng sỉ</span>
                        <span class="title-minimum">Tối thiểu 2 miếng</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <span class="title-quantity-sp">Số lượng bán của sản phẩm:</span>
                    <span class="content-quantity-sp">Đã bán <span style="color: #F9471B">55 </span>miếng trong 90 ngày</span>
                </div>
                <div class="d-flex box-attribute mt-4">
                    <div class="title-color">Màu sắc</div>
                    <div class="box-color">
                        @for($i=0;$i<8;$i++)
                        <div class="box-item-color @if($i==0) box-item-color-active @endif">
                            <img src="https://sabomall.com/product/empty_product_image.png" class="img-color">
                            <span>Màu đỏ</span>
                        </div>
                            @endfor
                    </div>
                </div>

                <div class="d-flex box-attribute mt-4">
                    <div class="title-color">Kích cỡ</div>
                    <div class="box-size">
                        @for($i=0;$i<4;$i++)
                            <div class="box-item-size">
                                <span class="title-size-item">Màu đỏ</span>
                                <div class="title-price-size">
                                    <p class="price_cn">¥90,00</p>
                                    <p class="price_vn">328.050₫</p>
                                </div>
                                <div class="title-note">
                                    9975 miếng có sẵn
                                </div>
                                <div class="box-quantity-fa">
                                    <button class="btn-minus-plus"><i class="fa-solid fa-minus"></i></button>
                                    <input type="number" class="input-quntity" value="0">
                                    <button class="btn-minus-plus"><i class="fa-solid fa-plus"></i></button>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center flex-wrap mt-4 mb-3 gap-3">
                    <button class="btn-add-cart"><i class="fa-solid fa-cart-shopping" style="margin-right: 5px"></i> Thêm vào giỏ hàng</button>
                    <div class="title-add-to-cart">
                        <i class="fa-solid fa-piggy-bank" style="color: rgb(58 161 117 / 1);padding-right: 5px"></i>
                        Hãy mua thêm sản phẩm để tối ưu phí vận chuyển
                    </div>
                </div>


            </div>

        </div>
    </div>

    <div class="box-content mt-3">
        <img src="https://sabomall.com/banner_top.png" class="w-100">

        <div class="box-list-content">
            <div class="line-home-title">
                <div class="title-big-shop">Sản Phẩm Tương tự</div>
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

        <div class="box-content-describe">
            <p class="title-content-detail">Mô tả sản phẩm</p>
            <div class="content-describe">
                Đây là nội dung
            </div>
        </div>

    </div>



@stop
@section('script_page')
    <script src="{{asset('assets/js/product.js')}}"></script>
@stop
