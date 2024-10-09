@extends('web.index')
@section('title','Tìm kiếm')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/category.css')}}">
    <style>
        #offcanvasFillter{
            height: 38vh!important;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

       <div class="d-flex justify-content-between align-items-center flex-wrap">
           <img src="https://sabomall.com/banner/banner-top.png" class="img-search-1">
           <img src="https://sabomall.com/banner/chrome-ext-2.png" class="img-search-2">
       </div>

        <div class="box-content-search">
            <div class="line-menu-search-category custom-shadow">
                <span class="title-menu-search">Tổng hợp</span>
                <form action="{{route('taobao.product.search')}}" method="GET"
                      class="box-filter-price d-flex align-items-center mx-3 gap-2">
                    <span class="title-item-search-menu">Khoảng giá:</span>
                    <input type="text" value="{{request()->get('keySearch')}}" name="keySearch" hidden>
                    <div class="box-number-search-menu">
                        <input type="text" placeholder="Giá thấp nhất" name="min_price"
                               value="{{request()->get('min_price')}}" class="input-search-price-menu">
                        <span class="title-đ">¥</span>
                    </div>
                    <div style="width: .375rem;height: 1px;background-color: rgba(85, 85, 85, .5)"></div>
                    <div class="box-number-search-menu">
                        <input type="text" placeholder="Giá cao nhất" name="max_price"
                               value="{{request()->get('max_price')}}" class="input-search-price-menu">
                        <span class="title-đ">¥</span>
                    </div>
                    <button type="submit" class="btn-search-price-menu">Tìm kiếm</button>
                    @if(request()->filled('min_price') || request()->filled('max_price'))
                        <a href="{{ url()->current() . '?keySearch=' . request()->get('keySearch') }}"
                           class="btn-delete-search-menu">
                            <i class="fa-regular fa-trash-can"></i>
                            Xóa bộ lọc
                        </a>
                    @endif
                </form>
                <button class="btn-filter" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFillter" aria-controls="offcanvasFillter"><i class="fa-solid fa-filter"></i></button>
            </div>
            <div class="d-flex align-items-center line-title-search">
                <span>Kết Quả Tìm Kiếm </span>
                <span>"{{$searchQuery}}"</span>
            </div>
            <div class="box-list-content py-3">
                <div class="content-search-sp">
                    @foreach($listData as $pro)
                        <a class="box-product-item" href="{{route('taobao.detail-product',$pro->slug)}}">
                            <div class="w-100 position-relative">
                                <img
                                    src="{{asset($pro->src)}}"
                                    class="w-100" style="object-fit: cover">
                            </div>
                            <div class="content-item-sp">
                                <div class="title-product-item custom-content-2-line">
                                    {{$pro->name}}
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="text-price-big-red">¥{{number_format($pro->price,2)}}</div>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <div class="text-price-big">{{number_format($pro->price*$setting->exchange_rate)}}
                                        đ
                                    </div>
                                </div>
                                <div class="title-sold">Đã bán {{number_format($pro->sold)}} sản phẩm</div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-4">
                    {{ $listData->appends(request()->all())->links('web.partials.pagination') }}
                </div>
            </div>
        </div>

    </div>

{{--    Bộ lọc mobile--}}
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasFillter" aria-labelledby="offcanvasFillterLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title title-menu-mobile" id="offcanvasRightLabel">Bộ lọc</h5>
            <button type="button" class="btn-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="offcanvas-body pt-3">
            <span class="title-item-search-menu mt-0">Khoảng giá:</span>
            <form action="{{route('taobao.product.search')}}" method="GET">
                <input type="text" value="{{request()->get('keySearch')}}" name="keySearch" hidden>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="box-number-search-menu">
                        <input type="text" placeholder="Giá thấp nhất" name="min_price"
                               value="{{request()->get('min_price')}}" class="input-search-price-menu">
                        <span class="title-đ">¥</span>
                    </div>
                    <div style="width: 10px;height: 1px;background-color: rgba(85, 85, 85, .5)"></div>
                    <div class="box-number-search-menu">
                        <input type="text" placeholder="Giá cao nhất" name="max_price"
                               value="{{request()->get('max_price')}}" class="input-search-price-menu">
                        <span class="title-đ">¥</span>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between mt-4">
                    @if(request()->filled('min_price') || request()->filled('max_price'))
                        <a href="{{ url()->current() . '?keySearch=' . request()->get('keySearch') }}"
                           class="btn-delete-search-sp">Xóa bộ lọc</a>
                    @endif
                    <button type="submit" class="btn-search-sp">Tìm kiếm</button>
                </div>
            </form>
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
