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
                    @foreach($categoryTaobao as $cate)
                        <div class="category-wrapper">
                        <a href="{{route('taobao.category',$cate->slug)}}" class="d-flex align-center gap-3 py-1">
                            <span class="item-category">{{$cate->name}}</span>
                        </a>
                        <div class="sub-category">
                            @foreach($cate->children as $cate2)
                            <a href="{{url('danh-muc/'.$cate->slug.'/'.$cate2->slug)}}" class="title-big-category">{{$cate2->name}}</a>
                            <div class="d-flex align-items-center flex-wrap mb-2">
                                @foreach($cate2->grandchildren as $cate3)
                                <a href="{{url('danh-muc/'.$cate->slug.'/'.$cate2->slug.'/'.$cate3->slug)}}" class="title-small-category">{{$cate3->name}}</a>
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
                        @if(!\Illuminate\Support\Facades\Auth::check())
                            <img src="{{asset('assets/images/icon-avatar-signup.svg')}}" alt="">
                            <span class="title-info-top">Đăng nhập ngay để bắt đầu mua sắm!!!</span>
                            @else
                            <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="" style="border-radius: 50%;width: 40px;height: 40px;object-fit: cover">
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
                <div class="title-big-deal">DEAL HOT</div>
                <a href="{{route('taobao.deal-hot')}}" class="link-more-deal">Xem thêm <i class="fa-solid fa-chevron-right"
                                                              style="padding-left: 7px"></i></a>
            </div>
            <div class="box-slide-product">
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @foreach($hotDealProducts as $hotDeal)
                            <div class="swiper-slide">
                                <a href="{{route('taobao.detail-product',$hotDeal->slug)}}" class="box-product-item">
                                    <div class="w-100 position-relative">
                                        <img
                                            src="{{$hotDeal->src}}"
                                            class="w-100" style="object-fit: cover">
                                        <div class="box-super-cheap">
                                            <img src="https://sabomall.com/tag.png" alt="" class="icon-cheap">
                                            SIÊU RẺ
                                        </div>
                                    </div>
                                    <div class="content-item-sp">
                                        <div class="title-product-item custom-content-2-line">
                                            {{$hotDeal->name}}
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big-red">¥{{number_format($hotDeal->price,2)}}</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big">{{number_format($hotDeal->price * $setting->exchange_rate)}}đ</div>
                                        </div>
                                        <div class="title-sold">Đã bán {{number_format($hotDeal->sold)}} sản phẩm</div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="swiper-button-next next-distributor"></div>
                    <div class="swiper-button-prev prev-distributor"></div>
                </div>
            </div>
        </div>

        @if(count($randomProducts)>0)
        <div class="box-list-content">
            <div class="line-home-title">
                <div class="title-big-shop">Đề xuất cho bạn</div>
                <a href="{{route('taobao.recommended-you')}}" class="link-more-deal">Xem thêm <i class="fa-solid fa-chevron-right"
                                                              style="padding-left: 7px"></i></a>
            </div>
            <div class="content-recommended">
                @foreach($randomProducts as $pro)
                    <a href="{{route('taobao.detail-product',$pro->slug)}}" class="box-product-item">
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
                                <div class="text-price-big">{{number_format($pro->price*$setting->exchange_rate)}}đ</div>
                            </div>
                            <div class="title-sold">Đã bán {{number_format($pro->sold)}} sản phẩm</div>
                        </div>
                    </a>
                    @endforeach
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $randomProducts->appends(request()->all())->links('web.partials.pagination') }}
            </div>
        </div>
            @endif

    </div>

@stop
@section('script_page')
    <script src="{{asset('assets/js/home.js')}}"></script>
@stop
