@extends('admin.layout.index')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single{
        padding-top: 3px;
        height: 40px;
    }
    .select2-container--default .select2-selection--single .select2-selection__placeholder,.select2-container--default .select2-results__option--highlighted.select2-results__option--selectable{
        color: black;
    }
</style>
@section('main')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Nạp tiền</h1>
        </div><!-- End Page Title -->
        <section class="section dashboard">
            <div class="p-4" style="background: white">
                <form action="{{route('admin.wallet.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-2">Người nạp :</div>
                        <div class="col-10">
                            <select class="form-select" id="user_id" name="user_id" required>
                                <option value="">Số điện thoại - Tên người dùng</option>
                                @foreach($listUser as $item)
                                    <option value="{{ $item->id }}" >{{ $item->phone }} - {{ $item->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Số tiền nạp :</div>
                        <div class="col-10">
                            <input class="form-control format-currency" name="amount" type="text" required>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-info text-white">
                            Nội dung nạp
                        </div>
                        <div class="card-body mt-2">
                            <textarea name="description" rows="5" class="form-control" required>{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">Loại tiền nạp :</div>
                        <div class="col-10">
                            <select name="wallet_type" class="form-control" required>
                                <option value="1">Tiền việt</option>
                                <option value="2">Tiền trung</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-3"></div>
                        <div class="col-8 ">
                            <button type="submit" class="btn btn-primary">Nạp tiền</button>
                            <a href="{{route('admin.wallet.index')}}" class="btn btn-danger">Hủy</a>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{url('assets/admin/js/format_currency.js')}}" type="text/javascript"></script>

    <script>
        $(document).ready(function() {
            $("#user_id").select2({
                placeholder: "Số điện thoại - Tên người dùng",
                allowClear: true
            });
        });
        </script>
@endsection
