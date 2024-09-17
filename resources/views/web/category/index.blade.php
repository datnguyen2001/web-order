@extends('web.index')
@section('title','Danh mục')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/category.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <img src="https://sabomall.com/banner_top.png" class="w-100" style="object-fit: cover">

        <div class="box-list-content">
            <div class="line-home-title">
                <div class="title-big-shop">Sản phẩm hot</div>
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

            <div class="line-home-title mt-3">
                <div class="title-big-shop">Thương hiệu siêu chiết khấu</div>
            </div>
            <div class="box-slide-product">
                <div class="swiper categoryShopSwiper">
                    <div class="swiper-wrapper">
                        @for($i=0;$i<10;$i++)
                            <div class="swiper-slide">
                                <a class="box-product-shop-item">
                                    <div class="w-100 img-product-shop-item">
                                        <img
                                            src="https://gobiz-dota.s3.ap-southeast-1.amazonaws.com/ancient/sabomall/f052d144-6891-4875-8fa3-1048381a1169.jpg"
                                            class="w-100" style="object-fit: cover">
                                    </div>
                                    <div class="title-product-shop-item custom-content-2-line" style="font-weight: 500">
                                        threasa365
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

        <div class="box-list-content-category">
            <div class="box-content-category-left">
                <a href="{{route('category',$cate->slug)}}" class="title-big-category-left @if(!$name && !$slug && $status == $cate->slug) link-menu-active @endif">{{$cate->name}}</a>
                <div class="box-left-item-menu">
                    @foreach($dataCategory as $cateTwo)
                    <div class="box-item-category-left">
                        <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}" class="title-small-category-left @if($name == $cateTwo->slug && !$slug ) link-menu-active @endif">{{$cateTwo->name}}</a>
                        <div class="box-item-menu-left">
                            @foreach($cateTwo->categoryThree as $cateThree)
                            <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}" class="link-item-category @if($slug == $cateThree->slug) link-menu-active @endif">{{$cateThree->name}}</a>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="box-content-category-right">
                <div class="line-menu-search-category custom-shadow">
                    <span class="title-menu-search">Tổng hợp</span>
                    <div class="box-filter-price d-flex align-items-center mx-3 gap-2">
                        <span class="title-item-search-menu">Khoảng giá:</span>
                        <div class="box-number-search-menu">
                            <input type="text" placeholder="Giá thấp nhất" class="input-search-price-menu">
                            <span class="title-đ">đ</span>
                        </div>
                        <div style="width: .375rem;height: 1px;background-color: rgba(85, 85, 85, .5)"></div>
                        <div class="box-number-search-menu">
                            <input type="text" placeholder="Giá cao nhất" class="input-search-price-menu">
                            <span class="title-đ">đ</span>
                        </div>
                        <button class="btn-search-price-menu">Tìm kiếm</button>
                        <span class="btn-delete-search-menu">
                            <i class="fa-regular fa-trash-can"></i>
                            Xóa bộ lọc
                        </span>
                    </div>
                    <button class="btn-filter" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFillter" aria-controls="offcanvasFillter"><i class="fa-solid fa-filter"></i></button>
                </div>
                <div class="box-list-content">
                    <div class="line-home-title">
                        <div class="title-big-shop">{{$name_category}}</div>
                    </div>
                    @if(count($listData)>0)
                    <div class="content-category-sp">
                       @foreach($listData as $pro)
                            <a href="{{route('detail-product',$pro->slug)}}" class="box-product-item">
                                <div class="w-100 position-relative">
                                    <img
                                        src="{{$pro->src}}"
                                        class="w-100" style="object-fit: cover">
                                </div>
                                <div class="content-item-sp">
                                    <div class="title-product-item custom-content-2-line">
                                       {{$pro->name}}
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="text-price-big-red">¥{{number_format($pro->price)}}</div>
{{--                                        <div class="text-price-red">¥44,60</div>--}}
                                    </div>
                                    <div class="d-flex align-items-baseline">
                                        <div class="text-price-big">{{number_format($pro->price*$setting->exchange_rate)}}đ</div>
{{--                                        <div class="text-price-small">¥44,60</div>--}}
                                    </div>
                                    <div class="title-sold">Đã bán {{$pro->sold}} sản phẩm</div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-2">
                        {{ $listData->appends(request()->all())->links('admin.pagination_custom.index') }}
                    </div>
                        @else
                        <div class="d-flex justify-content-center mt-2" style="color: #F9471B">
                            Không có dữ liệu
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

{{--    Bộ lọc mobile--}}
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFillter" aria-labelledby="offcanvasFillterLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title title-menu-mobile" id="offcanvasRightLabel">Bộ lọc</h5>
            <button type="button" class="btn-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="offcanvas-body pt-3">
            <div class=" w-100">
                <a href="{{route('category',$cate->slug)}}" class="title-big-category-left @if(!$name && !$slug && $status == $cate->slug) link-menu-active @endif">{{$cate->name}}</a>
                <div class="box-left-item-menu">
                    @foreach($dataCategory as $cateTwo)
                    <div class="box-item-category-left">
                        <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}" class="title-small-category-left @if($name == $cateTwo->slug && !$slug ) link-menu-active @endif">{{$cateTwo->name}}</a>
                        <div class="box-item-menu-left">
                            @foreach($cateTwo->categoryThree as $cateThree)
                            <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}" class="link-item-category @if($slug == $cateThree->slug) link-menu-active @endif">{{$cateThree->name}}</a>
                            @endforeach
                        </div>
                    </div>
                        @endforeach
                </div>
            </div>
            <span class="title-item-search-menu">Khoảng giá:</span>
            <div class="d-flex align-items-center justify-content-between">
                <div class="box-number-search-menu">
                    <input type="text" placeholder="Giá thấp nhất" class="input-search-price-menu">
                    <span class="title-đ">đ</span>
                </div>
                <div style="width: 10px;height: 1px;background-color: rgba(85, 85, 85, .5)"></div>
                <div class="box-number-search-menu">
                    <input type="text" placeholder="Giá cao nhất" class="input-search-price-menu">
                    <span class="title-đ">đ</span>
                </div>
            </div>
            <button class="btn-search-price-menu">Tìm kiếm</button>
            <span class="btn-delete-search-menu">
                            <i class="fa-regular fa-trash-can"></i>
                            Xóa bộ lọc
                        </span>
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
