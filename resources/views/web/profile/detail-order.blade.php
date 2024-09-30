@extends('web.index')
@section('title','Chi tiết đơn hàng')

@section('style_page')
    <link rel="stylesheet" href="{{asset('assets/css/pay.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/profile.css')}}">
    <style>
        .main {
            padding-bottom: 80px;
        }
    </style>
@stop
{{--content of page--}}
@section('content')
    <div class="box-content">

        <div class="box-search-order custom-shadow mt-0">
            <p class="title-search-order">Trạng thái: <span style="color: #F9471B">{{$data->statusName}}</span></p>
        </div>

        <div class="box-search-order custom-shadow d-flex justify-content-between flex-wrap gap-2">
            <div class="box-one-info">
                <p class="title-info-order">Thông tin đơn hàng</p>
                <div class="content-info-order">Mã đơn hàng: <span
                        style="color:#F9471B;font-weight: 500;margin-left: 15px">{{$data->order_code??'Đang cập nhật'}}</span>
                </div>
                <div class="content-info-order">Phương thức thanh toán: <span
                        style="color:#F9471B;font-weight: 500;margin-left: 15px">{{$data->payment_type == 2?'Chuyển khoản':'Ví'}}</span>
                </div>
            </div>
            <div class="box-one-info">
                <p class="title-info-order">Thông Tin Người Nhận</p>
                <div class="content-info-order">{{$data->shippingAddress[0]->name}}
                    ({{$data->shippingAddress[0]->phone}})
                </div>
                <div class="content-info-order">{{$data->shippingAddress[0]->detail_address}}
                    , {{$data->shippingAddress[0]->province->name}}, {{$data->shippingAddress[0]->district->name}}
                    , {{$data->shippingAddress[0]->ward->name}}</div>
            </div>
            <div class="box-one-info">
                <p class="title-info-order">Cần Thanh Toán</p>
                <div
                    class="price-info-order text-end">@if($data->payment_currency == 1) {{number_format(($data->total_payment_vietnamese - $data->deposit_money))}}
                    ₫ @else ¥{{($data->total_payment_chinese - $data->deposit_money)}}@endif </div>
            </div>
        </div>

        <div class="box-content-order">
            <div class="box-order-item p-2 mt-0">
                <div class="item-order-left">
                    <div class="line-table-header">
                        <span>Sản phẩm</span>
                        <span>Đơn giá</span>
                        <span>Số lượng</span>
                        <span>Thành tiền</span>
                    </div>

                    @foreach($groupedItems as $key => $item)
                        <div class="item-product-order mb-4">
                            <div class="w-100 d-flex gap-2 align-items-center mb-2">
                                <span>{{$item['index']}}</span>
                                <img src="{{$item['image']}}" class="img-sp-order">
                                <div class="d-flex flex-column w-100">
                                    <div class="name-product-item custom-content-2-line">{{$item['product_name']}}</div>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="title-menu-order">Số lượng: <b>{{$item['quantity']}}</b></div>
                                        <div class="title-menu-order">Thuộc tính: <b>{{count($item['attributes'])}}</b>
                                        </div>
                                        <div class="d-flex flex-column align-items-end">
                                            <span class="price-sale-total-sp">¥{{$item['price_chinese']}}</span>
                                            <span
                                                class="price-total-sp">{{number_format($item['price_vietnamese'])}}₫</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($item['attributes'] as $value)
                                <div class="item-attribute-product mb-2">
                                    <div class="d-flex align-items-center gap-3">
                                        <img
                                            src="https://global-img-cdn.1688.com/img/ibank/O1CN01PgvQMg1IloidmbXdn_!!2208204380934-0-cib.jpg"
                                            class="img-sp-attr-order">
                                        <div class="name-attr-sp">
                                            Đặc điểm: <b>{{$value['value_name']}}, {{$value['attribute_name']}}</b>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span class="price-total-sp"
                                              style="font-weight: 600">¥{{$value['price_chinese']}}</span>
                                        <span
                                            class="price-total-sp">{{number_format($value['price_vietnamese'])}}₫</span>
                                    </div>
                                    <div style="font-size: 14px;color: #6F6F6F">{{$value['quantity']}}</div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span class="price-total-sp"
                                              style="font-weight: 600">¥{{$value['total_chinese_price']}}</span>
                                        <span class="price-total-sp">{{number_format($value['total_vietnamese_price'])}}₫</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                    <div class="d-flex align-items-center">
                        <input type="checkbox" @if($data->is_tally == 1) checked @endif>
                        <label for="" style="color: #1a1a1a;font-size: 12px;margin-left: 5px;margin-bottom: 1px"> Kiểm
                            hàng</label>
                    </div>
                    <div class="w-100 d-flex flex-column gap-1 mt-3 mb-3">
                        <span style="font-size: 12px;color: #111827">Ghi chú đơn hàng</span>
                        <textarea name="" class="note-order" rows="5" readonly
                                  placeholder="Ghi chú">{{$data->note}}</textarea>
                    </div>
                </div>
                <div class="item-order-right">
                    <div class="item-child-price">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span class="title-item-child-price">Vốn Hàng Hóa (98%)</span>
                            <div class="d-flex flex-column align-items-end">
                                <span class="price-total-sp" style="font-weight: 600;font-size: 16px">¥{{$data->goods_money_chinese + $data->china_domestic_shipping_fee_chinese + $data->discount_chinese}}</span>
                                <span class="price-total-sp">{{number_format($data->goods_money_vietnamese + $data->china_domestic_shipping_fee_vietnamese + $data->discount_vietnamese)}}₫</span>
                            </div>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>1. Tiền hàng</span>
                            <span>¥{{$data->goods_money_chinese}}</span>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>2. Phí vận chuyển nội địa TQ</span>
                            <span>¥{{$data->china_domestic_shipping_fee_chinese}}</span>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>3. Giảm giá</span>
                            <span>¥{{$data->discount_chinese}}</span>
                        </div>
                    </div>
                    <div class="item-child-price line-top-child-price">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span class="title-item-child-price">Phí nhập hàng (2%)</span>
                            <div class="d-flex flex-column align-items-end">
                                <span class="price-total-sp" style="font-weight: 600;font-size: 16px">¥{{$data->international_shipping_fee_chinese + $data->vietnam_domestic_shipping_fee_chinese + $data->insurance_fee_chinese + $data->partial_payment_fee_chinese + $data->tally_fee_chinese}}</span>
                                <span class="price-total-sp">{{number_format($data->international_shipping_fee_vietnamese + $data->vietnam_domestic_shipping_fee_vietnamese + $data->insurance_fee_vietnamese + $data->partial_payment_fee_vietnamese + $data->tally_fee_vietnamese)}}₫</span>
                            </div>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>1. Phí vận chuyển quốc tế</span>
                            <span>¥{{$data->international_shipping_fee_chinese}}</span>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>2. Phí vận chuyển nội địa Việt Nam</span>
                            <span>¥{{$data->vietnam_domestic_shipping_fee_chinese}}</span>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>3. Phí dịch vụ đảm bảo hàng hoá</span>
                            <span>¥{{$data->insurance_fee_chinese}}</span>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>4. Phí thanh toán 1 phần</span>
                            <span>¥{{$data->partial_payment_fee_chinese}}</span>
                        </div>
                        <div class="line-title-item-child-price">
                            <span>5. Phí kiểm hàng</span>
                            <span>¥{{$data->tally_fee_chinese}}</span>
                        </div>
                    </div>
                    <div class="item-child-price line-top-child-price">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span class="title-item-child-price-all">Tổng Chi Phí</span>
                            <div class="d-flex flex-column align-items-end">
                                    <span class="price-total-sp-all-big">¥{{$data->total_payment_chinese}}</span>
                                    <span class="price-total-sp-all">{{number_format($data->total_payment_vietnamese)}}₫</span>
                            </div>
                        </div>
                    </div>
                    <div class="item-child-price pt-0">
                        <div class="d-flex justify-content-between align-items-center w-100">
                            <span class="title-item-child-price-all" style="font-size: 15px">Đã Thanh Toán:</span>
                            <div class="d-flex flex-column align-items-end">
                                @if($data->payment_currency == 2)
                                    <span class="price-total-sp-all-big"
                                          style="color: rgb(58 161 117/ 1);font-size: 15px">¥{{$data->deposit_money}}</span>
                                @else
                                    <span class="price-total-sp-all"
                                          style="color: rgb(58 161 117/ 1);font-size: 15px">{{number_format($data->deposit_money)}}₫</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@stop
@section('script_page')

@stop
