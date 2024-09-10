@extends('web.index')
@section('title','Xem thêm')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/category.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <img src="https://sabomall.com/banner_top.png" class="w-100" style="object-fit: cover">

        <div class="box-list-content py-3">
            <div class="line-home-title px-3 mb-3">
                <div class="title-big-shop">Sản phẩm bán chạy</div>
            </div>
            <div class="content-more-sp">
                @for($i=0;$i<20;$i++)
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
    <script>
        var productSwiper = new Swiper(".productSwiper", {
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                1200: {
                    slidesPerView: 5,
                    spaceBetween: 15,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                }
            }
        });

        var categoryShopSwiper = new Swiper(".categoryShopSwiper", {
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                1200: {
                    slidesPerView: 8,
                    spaceBetween: 20,
                },
                992: {
                    slidesPerView: 7,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 5,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 3,
                    spaceBetween: 10,
                }
            }
        });
    </script>
@stop
