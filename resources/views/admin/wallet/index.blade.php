@extends('admin.layout.index')
@section('main')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="card-title">{{$titlePage}}</h5>
                                <a class="btn btn-success"
                                   href="{{route('admin.wallet.create')}}">Nạp tiền</a>
                            </div>

                            <form action="{{ route('admin.wallet.index') }}" class="d-flex align-items-center mb-3" method="GET">
                                <input type="text" name="key_search" class="form-control w-50" style="margin-right: 16px" placeholder="Nhập tên người nạp, số điện thoại hoặc mã giao dịch" value="{{ request('key_search') }}">
                                <button type="submit" class="btn btn-info" >Tìm kiếm</button>
                                <a href="{{route('admin.wallet.index')}}" class="btn btn-danger" style="margin-left: 15px">Hủy </a>
                            </form>

                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th scope="col">STT</th>
                                    <th scope="col">Mã giao dịch</th>
                                    <th scope="col">Chủ tài khoản</th>
                                    <th scope="col">Nội dung</th>
                                    <th scope="col">Giá trị nạp</th>
                                    <th scope="col">Thể loại</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listData as $key => $value)
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>
                                            <span style="font-size: 13px">{{$value->created_at}}</span><br>
                                            {{$value->transaction_code}}
                                        </td>
                                        <td>
                                            {{$value->user->full_name}} <br> {{$value->user->phone}}
                                        </td>
                                        <td>
                                            {{$value->description}}
                                        </td>
                                        <td>
                                            {{number_format($value->amount)}} @if($value->wallet_type == 1)đ@else¥@endif
                                        </td>
                                        <td>
                                            @if($value->type == 1)
                                                Nạp tiền
                                                @else
                                                Thanh toán đơn hàng
                                            @endif
                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $listData->appends(request()->all())->links('admin.pagination_custom.index') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main><!-- End #main -->
@endsection
@section('script')
    <script>
        $('a.btn-delete').confirm({
            title: 'Xác nhận!',
            content: 'Bạn có chắc chắn muốn xóa bản ghi này?',
            buttons: {
                ok: {
                    text: 'Xóa',
                    btnClass: 'btn-danger',
                    action: function () {
                        location.href = this.$target.attr('href');
                    }
                },
                close: {
                    text: 'Hủy',
                    action: function () {
                    }
                }
            }
        });
    </script>
@endsection
