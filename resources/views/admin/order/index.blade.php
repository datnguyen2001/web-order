@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body d-flex align-items-center flex-wrap"
                             style="padding-top: 20px;gap: 15px">
                            <a href="{{url('admin/order/index/all')}}" type="button"
                               class="btn btn-outline-secondary mb @if($status == 'all') active @endif"> Tất cả đơn hàng</a>
                            <a href="{{url('admin/order/index/0')}}"
                               class="btn btn-outline-warning @if($status == 0) active @endif">Chờ Xác nhận thanh toán </a>
                            <a href="{{url('admin/order/index/2')}}"
                               class="btn btn-outline-warning @if($status == 2) active @endif">Chờ duyệt </a>
                            <a href="{{url('admin/order/index/1')}}" type="button"
                               class="btn btn-outline-info @if($status == 1) active @endif">Đã ký gửi </a>
                            <a href="{{url('admin/order/index/3')}}" type="button"
                               class="btn btn-outline-primary @if($status == 3) active @endif">Người bán giao</a>
                            <a href="{{url('admin/order/index/4')}}" type="button"
                               class="btn btn-outline-success @if($status == 4) active @endif">Hàng về kho trung quốc </a>
                            <a href="{{url('admin/order/index/5')}}" type="button"
                               class="btn btn-outline-secondary @if($status == 5) active @endif">Vận chuyển quốc tế </a>
                            <a href="{{url('admin/order/index/6')}}" type="button"
                               class="btn btn-outline-warning @if($status == 6) active @endif">Chờ giao </a>
                            <a href="{{url('admin/order/index/7')}}" type="button"
                               class="btn btn-outline-info @if($status == 7) active @endif">Đang giao </a>
                            <a href="{{url('admin/order/index/8')}}" type="button"
                               class="btn btn-outline-success @if($status == 8) active @endif">Đã nhận hàng </a>
                            <a href="{{url('admin/order/index/9')}}" type="button"
                               class="btn btn-outline-danger @if($status == 9) active @endif">Đã hủy </a>
                            <a href="{{url('admin/order/index/10')}}" type="button"
                               class="btn btn-outline-danger @if($status == 10) active @endif">Thất lạc </a>
                            <a href="{{url('admin/order/index/11')}}" type="button"
                               class="btn btn-outline-danger @if($status == 11) active @endif">Không nhận hàng </a>
                        </div>
                    </div>
                    <div class="card" >
                        <div class="card-body d-flex justify-content-end" style="padding: 20px">
                            <form class="d-flex align-items-center w-50" method="get"
                                  action="{{url('admin/order')}}">
                                <input name="search" type="text" value="{{request()->get('search')}}"
                                       placeholder="Tìm kiếm theo mã đơn hàng" class="form-control" style="margin-right: 16px">
                                <button class="btn btn-info" style="margin-left: 15px"><i class="bi bi-search"></i>
                                </button>
                                <a href="{{url('admin/order')}}" class="btn btn-danger"
                                   style="margin-left: 15px">Hủy </a>
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">{{$titlePage}}</h5>
                            </div>
                            @if(count($listData) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Mã đơn</th>
                                        <th scope="col">Bên nhận</th>
                                        <th scope="col" style="width: 12%;">Số tiền đã cọc</th>
                                        <th scope="col" style="width: 12%;">Tổng tiền hàng</th>
                                        <th scope="col" style="width: 15%;">Xác nhận nhanh</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listData as $k => $value)
                                        <tr>
                                            <th id="{{$value->id}}" scope="row">{{$k+1}}</th>
                                            <td>
                                                <span class="btn btn-icon btn-light btn-hover-success btn-sm">
                                                    {{$value->order_code}}<br>
                                                    Trạng thái: <span style="color: red">{{$value->name_status}}</span>
                                                    <br>{{$value->created_at}}
                                                </span>
                                            </td>
                                            <td>
                                                {{$value->name}}<br>
                                                {{$value->phone}}<br>
                                                {{$value->detail_address}}, {{$value->ward_name}}, {{$value->district_name}}, {{$value->province_name}}
                                            </td>
                                            <td>
                                                @if($value->payment_currency == 1)
                                                    {{number_format($value->deposit_money)}}đ
                                                @else
                                                    ¥{{number_format($value->deposit_money,2,',','.')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if($value->payment_currency == 1)
                                                {{number_format($value->total_payment_vietnamese)}}đ
                                                    @else
                                                    ¥{{number_format($value->total_payment_chinese,2,',','.')}}
                                                @endif
                                            </td>
                                            <td style="border-top: 1px solid #cccccc">
                                                @if($value->status_id == 0)
                                                    <a href="{{url('admin/order/status/'.$value->id.'/2')}}">
                                                        <button type="submit" class="btn btn-primary mb-2">Xác nhận đơn
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/9')}}">
                                                        <button type="submit" class="btn btn-danger">Huỷ đơn hàng
                                                        </button>
                                                    </a>
                                                    @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    {{ $listData->appends(request()->all())->links('admin.pagination_custom.index') }}
                                </div>
                            @else
                                <h5 class="card-title">Không có dữ liệu</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
@section('script')

@endsection
