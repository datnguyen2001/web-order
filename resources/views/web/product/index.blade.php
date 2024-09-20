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
                        @foreach($productImg as $image)
                        <div class="swiper-slide">
                            <img src="{{$image->src}}" class="img-detail-sp"/>
                        </div>
                       @endforeach
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="swiper mySwiper mt-2">
                    <div class="swiper-wrapper">
                        @foreach($productImg as $image)
                        <div class="swiper-slide">
                            <img src="{{$image->src}}" class="img-detail-sp"/>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="box-content-detail">
                <p class="name-detail-sp">{{$data->name}}</p>
                <img src="https://sabomall.com/banner_top_3.png" class="w-100">
                <div class="box-price-detail">
                        <div class="d-flex mb-1">
                            <span class="title-price-detail">Giá gốc</span>
                            <span class="price-detail-big">¥{{number_format($productAttribute[0]->price??$data->price,2)}}</span>
                        </div>
                    <div class="d-flex mb-2">
                        <span class="title-price-detail">Giá VNĐ</span>
                        <span class="price-detail-small">{{number_format(($productAttribute[0]->price??$data->price) * $setting->exchange_rate)}}₫</span>
                    </div>
                </div>
                <div class="d-flex align-items-center mt-3">
                    <span class="title-quantity-sp">Số lượng bán của sản phẩm:</span>
                    <span class="content-quantity-sp">Đã bán <span style="color: #F9471B">{{number_format($data->sold)}} </span>sản phẩm</span>
                </div>

                @if(count($productValue) > 0)
                    <div class="d-flex box-attribute mt-4">
                        <div class="title-color">Đặc điểm</div>
                        <div class="box-color">
                            @foreach($productValue as $key => $val)
                                <div class="box-item-color @if($key == 0) box-item-color-active @endif"
                                     data-index="{{ $key }}" data-value-id="{{$val->id}}" data-value-name="{{$val->name}}"
                                     data-exchange-rate="{{$setting->exchange_rate}}">
                                    @if($val->src)
                                        <img src="{{$val->src}}" class="img-color">
                                    @endif
                                    <span>{{$val->name}}</span>
                                    <div class="prop-item-total">x0</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if(count($productAttribute) > 0)
                    <div class="d-flex box-attribute mt-4">
                        <div class="title-color">Thuộc tính</div>
                        <div class="box-size" id="box-size">
                            @foreach($productAttribute as $index => $item)
                                <div class="box-item-size" data-index="{{ $index }}" data-attribute-name="{{$item->name}}"
                                     data-product-name="{{$item->product_name}}" data-value-name="{{$item->product_value_name}}"
                                     data-product-image="{{$item->product_image}}" data-product-value-image="{{$item->product_value_src}}"
                                     data-attribute-chinese-price="{{$item->price}}" data-attribute-vietnamese-price="{{$item->price * $setting->exchange_rate}}">
                                    <span class="title-size-item">{{$item->name}}</span>
                                    <div class="title-price-size">
                                        <p class="price_cn">¥{{number_format($item->price,2)}}</p>
                                        <p class="price_vn">{{number_format($item->price * $setting->exchange_rate)}}₫</p>
                                    </div>
                                    <div class="title-note">
                                        {{number_format($item->quantity)}} sản phẩm có sẵn
                                    </div>
                                    <div class="box-quantity-fa">
                                        <button class="btn-minus-plus" data-type="minus"><i class="fa-solid fa-minus"></i></button>
                                        <input type="number" class="input-quntity" value="0" data-index="{{ $index }}">
                                        <button class="btn-minus-plus" data-type="plus"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                <div class="d-flex align-items-start mt-3">
                    <div class="line-left-more"></div>
                    <button class="btn-show-more" id="show-more"><i class="fa-solid fa-angle-down"></i></button>
                    <div class="line-right-more"></div>
                </div>
                    @else
                    <div class="d-flex align-items-center mt-2" id="quantity-no-attribute" style="gap: 10px"
                        data-product-name="{{$data->name}}" data-value-name="{{$data->name}}" data-attribute-name="{{null}}"
                        data-product-image="{{$data->src}}" data-product-value-image="{{$data->src}}"
                        data-attribute-chinese-price="{{$data->price}}" data-attribute-vietnamese-price="{{$data->price * $setting->exchange_rate}}">
                        <div class="box-quantity-fa">
                            <button class="btn-minus-plus" data-type="minus"><i class="fa-solid fa-minus"></i></button>
                            <input type="number" class="input-quntity" value="0">
                            <button class="btn-minus-plus" data-type="plus"><i class="fa-solid fa-plus"></i></button>
                        </div>
                        <div class="title-note" style="width: fit-content">
                            {{number_format($data->quantity)}} sản phẩm có sẵn
                        </div>
                    </div>
                @endif
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

        @if(count($SimilarProducts)>0)
        <div class="box-list-content">
            <div class="line-home-title">
                <div class="title-big-shop">Sản Phẩm Tương tự</div>
            </div>
            <div class="box-slide-product">
                <div class="swiper productSwiper">
                    <div class="swiper-wrapper">
                        @foreach($SimilarProducts as $similar)
                            <div class="swiper-slide">
                                <a href="{{route('detail-product',$similar->slug)}}" class="box-product-item">
                                    <div class="w-100 position-relative">
                                        <img
                                            src="{{$similar->src}}"
                                            class="w-100" style="object-fit: cover">
                                    </div>
                                    <div class="content-item-sp">
                                        <div class="title-product-item custom-content-2-line">
                                            {{$similar->name}}
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big-red">¥{{number_format($similar->price,2)}}</div>
                                        </div>
                                        <div class="d-flex align-items-baseline">
                                            <div class="text-price-big">{{number_format($similar->price*$setting->exchange_rate)}}đ</div>
                                        </div>
                                        <div class="title-sold">Đã bán {{number_format($similar->sold)}} sản phẩm</div>
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
@endif

        <div class="box-content-describe">
            <p class="title-content-detail">Mô tả sản phẩm</p>
            <div class="content-describe">
                {!! $data->description !!}
            </div>
        </div>

    </div>



@stop
@section('script_page')
    <script src="{{asset('assets/js/product.js')}}"></script>
    <script>
        var cartUrl = "{{ route('cart') }}";
        var loginUrl = "{{route('login')}}"

        $(document).ready(function() {
            $('.content-describe a').on('click', function(event) {
                event.preventDefault();
            });
            var $boxSize = $('#box-size');
            var $showMoreButton = $('#show-more');

            if ($boxSize[0].scrollHeight > $boxSize.outerHeight()) {
                $showMoreButton.show();
            }

            $showMoreButton.on('click', function() {
                $boxSize.toggleClass('expanded');
                if ($boxSize.hasClass('expanded')) {
                    $showMoreButton.html('<i class="fa-solid fa-angle-up"></i>');
                } else {
                    $showMoreButton.html('<i class="fa-solid fa-angle-down"></i>');
                    $('html, body').animate({ scrollTop: 200 }, 200);
                }
            });
        });
    </script>
@stop
