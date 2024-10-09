@extends('web.index')
@section('title',$nameCate)

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/category.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <img src="https://sabomall.com/banner_top.png" class="w-100" style="object-fit: cover">

        <div class="box-list-content py-3">
            <div class="line-home-title px-3 mb-3">
                <div class="title-big-shop">{{$nameCate}}</div>
            </div>
            @if(count($listData)>0)
            <div class="content-more-sp">
                @foreach($listData as $item)
                    <a href="{{route('taobao.detail-product',$item->slug)}}" class="box-product-item">
                        <div class="w-100 position-relative">
                            <img
                                src="{{$item->src}}"
                                class="w-100" style="object-fit: cover">
                        </div>
                        <div class="content-item-sp">
                            <div class="title-product-item custom-content-2-line">
                                {{$item->name}}
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="text-price-big-red">¥{{number_format($item->price,2)}}</div>
                            </div>
                            <div class="d-flex align-items-baseline">
                                <div class="text-price-big">{{number_format($item->price*$setting->exchange_rate)}}đ</div>
                            </div>
                            <div class="title-sold">Đã bán {{number_format($item->sold)}} sản phẩm</div>
                        </div>
                    </a>
                @endforeach
            </div>
                <div class="d-flex justify-content-center mt-3">
                    {{ $listData->appends(request()->all())->links('web.partials.pagination') }}
                </div>
                @endif
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
