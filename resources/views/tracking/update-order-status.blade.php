@extends('tracking.master')

@section('content')
    <style>
        .btn-update-status{
            width: 30%;
            margin: 0 auto;
        }
    </style>
    <div class="header">
        <nav class="pt-4 pb-4 px-0">
                <div class="order-0 mb-3 mb-md-0 px-0">
                    <div class="input-group flex-nowrap input-group-lg align-items-center">
                        <a href="{{route('admin.tracking.home.index')}}">
                            <img src="{{asset('assets/tracking/images/back-icon.png')}}" alt="Back" width="24" height="24" class="mr-2"/>
                        </a>
                        <h4 class="mb-0">Cập nhật trạng thái đơn hàng</h4>
                    </div>
                </div>
        </nav>
    </div>

    <form action="{{ route('admin.api.package') }}" method="POST">
        <div class="row mr-0 ml-0">
            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::label('create_time', 'Thời gian tạo:', ['class' => 'form-label']) !!}
                    <div class="row">
                        <div class="col-md-6 p-0">
                            {!! Form::date('created_at_from', old('created_at_from', request()->created_at_from), ['class' => 'form-control', 'id' => 'created_at_from', 'placeholder' => 'Bắt Đầu', 'required']) !!}
                        </div>
                        <div class="col-md-6 p-0">
                            {!! Form::date('created_at_to', old('created_at_to', request()->created_at_to), ['class' => 'form-control', 'id' => 'created_at_to', 'placeholder' => 'Kết Thúc', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info btn-update-status">Cập nhật</button>
        </div>
    </form>

{{--    <script>--}}
{{--        document.getElementById('packageForm').addEventListener('submit', function(event) {--}}
{{--            event.preventDefault();--}}

{{--            const createTimeFrom = document.getElementById('created_at_from').value;--}}
{{--            const createTimeTo = document.getElementById('created_at_to').value;--}}

{{--            this.action = ``;--}}

{{--            // document.getElementById('created_at_from').removeAttribute('name');--}}
{{--            // document.getElementById('created_at_to').removeAttribute('name');--}}

{{--            this.submit();--}}
{{--        });--}}
{{--    </script>--}}


@endsection
