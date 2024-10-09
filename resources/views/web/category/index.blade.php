@extends('web.index')
@section('title','Danh mục')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/category.css')}}">
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <img src="https://sabomall.com/banner_top.png" class="w-100" style="object-fit: cover">

        <div class="box-list-content-category">
            <div class="box-content-category-left">
                <a href="{{route('category',$cate->slug)}}"
                   class="title-big-category-left @if(!$name && !$slug && $status == $cate->slug) link-menu-active @endif">{{$cate->name}}</a>
                <div class="box-left-item-menu">
                    @foreach($dataCategory as $cateTwo)
                        <div class="box-item-category-left">
                            <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}"
                               class="title-small-category-left @if($name == $cateTwo->slug && !$slug ) link-menu-active @endif">{{$cateTwo->name}}</a>
                            <div class="box-item-menu-left">
                                @foreach($cateTwo->categoryThree as $cateThree)
                                    <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}"
                                       class="link-item-category @if($slug == $cateThree->slug) link-menu-active @endif">{{$cateThree->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="box-content-category-right">
                <form @if(!$name && !$slug && $status ) action="{{route('category',$cate->slug)}}"
                      @elseif($name && !$slug && $status) action="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}"
                      @else action="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}"
                      @endif method="GET">
                    <div class="line-menu-search-category custom-shadow">
                        <span class="title-menu-search">Tổng hợp</span>
                        <div class="box-filter-price d-flex align-items-center mx-3 gap-2">
                            <span class="title-item-search-menu">Khoảng giá:</span>
                            <div class="box-number-search-menu">
                                <input type="text" placeholder="Giá thấp nhất" name="min_price"
                                       class="input-search-price-menu text-center" value="{{request()->get('min_price')}}">
                                <span class="title-đ">¥</span>
                            </div>
                            <div style="width: .375rem;height: 1px;background-color: rgba(85, 85, 85, .5)"></div>
                            <div class="box-number-search-menu">
                                <input type="text" placeholder="Giá cao nhất" name="max_price"
                                       class="input-search-price-menu text-center" value="{{request()->get('max_price')}}">
                                <span class="title-đ">¥</span>
                            </div>
                            <button class="btn-search-price-menu">Tìm kiếm</button>
                            @if(request()->filled('min_price') || request()->filled('max_price'))
                                <a @if(!$name && !$slug && $status ) href="{{route('category',$cate->slug)}}"
                                   @elseif($name && !$slug && $status) href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}"
                                   @else href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}"
                                   @endif class="btn-delete-search-menu">
                                    <i class="fa-regular fa-trash-can"></i>
                                    Xóa bộ lọc
                                </a>
                            @endif
                        </div>
                        <button class="btn-filter" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasFillter" aria-controls="offcanvasFillter"><i
                                class="fa-solid fa-filter"></i></button>
                    </div>
                </form>
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
                                            <div class="text-price-big-red">¥{{number_format($pro->price,2)}}</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div
                                                class="text-price-big">{{number_format($pro->price*$setting->exchange_rate)}}
                                                đ
                                            </div>
                                        </div>
                                        <div class="title-sold">Đã bán {{$pro->sold}} sản phẩm</div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $listData->appends(request()->all())->links('web.partials.pagination') }}
                        </div>
                    @else
                        <div class="d-flex justify-content-center mt-3" style="color: #F9471B">
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
            <button type="button" class="btn-close-menu" data-bs-dismiss="offcanvas" aria-label="Close"><i
                    class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="offcanvas-body pt-3">
            <div class=" w-100">
                <a href="{{route('category',$cate->slug)}}"
                   class="title-big-category-left @if(!$name && !$slug && $status == $cate->slug) link-menu-active @endif">{{$cate->name}}</a>
                <div class="box-left-item-menu">
                    @foreach($dataCategory as $cateTwo)
                        <div class="box-item-category-left">
                            <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}"
                               class="title-small-category-left @if($name == $cateTwo->slug && !$slug ) link-menu-active @endif">{{$cateTwo->name}}</a>
                            <div class="box-item-menu-left">
                                @foreach($cateTwo->categoryThree as $cateThree)
                                    <a href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}"
                                       class="link-item-category @if($slug == $cateThree->slug) link-menu-active @endif">{{$cateThree->name}}</a>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <span class="title-item-search-menu">Khoảng giá:</span>
            <form @if(!$name && !$slug && $status ) action="{{route('category',$cate->slug)}}"
                  @elseif($name && !$slug && $status) action="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}"
                  @else action="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}"
                  @endif method="GET">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="box-number-search-menu">
                        <input type="text" placeholder="Giá thấp nhất" class="input-search-price-menu text-center" name="min_price" value="{{request()->get('min_price')}}">
                        <span class="title-đ">¥</span>
                    </div>
                    <div style="width: 10px;height: 1px;background-color: rgba(85, 85, 85, .5)"></div>
                    <div class="box-number-search-menu">
                        <input type="text" placeholder="Giá cao nhất" class="input-search-price-menu text-center" name="max_price" value="{{request()->get('max_price')}}">
                        <span class="title-đ">¥</span>
                    </div>
                </div>
                <button type="submit" class="btn-search-price-menu">Tìm kiếm</button>
                @if(request()->filled('min_price') || request()->filled('max_price'))
                    <a @if(!$name && !$slug && $status ) href="{{route('category',$cate->slug)}}"
                       @elseif($name && !$slug && $status) href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug)}}"
                       @else href="{{url('danh-muc/'.$cate->slug.'/'.$cateTwo->slug.'/'.$cateThree->slug)}}"
                       @endif class="btn-delete-search-menu">
                        <i class="fa-regular fa-trash-can"></i>
                        Xóa bộ lọc
                    </a>
                @endif
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
