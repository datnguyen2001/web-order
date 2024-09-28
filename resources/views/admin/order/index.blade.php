@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
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
                                                    <a href="{{url('admin/order/status/'.$value->id.'/2')}}">
                                                        <button type="submit" class="btn btn-primary mb-2">Xác nhận đơn
                                                        </button>
                                                    </a>
                                                    <a href="{{url('admin/order/status/'.$value->id.'/9')}}">
                                                        <button type="submit" class="btn btn-danger">Huỷ đơn hàng
                                                        </button>
                                                    </a>
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
