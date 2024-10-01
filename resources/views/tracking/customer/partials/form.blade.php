<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row">
            <div class="col-md-12">
                {!! Form::model($customer, ['route' => ['admin.tracking.customer.update', $customer->id], 'method' => 'PUT']) !!}
                <div class="form-group">
                    {!! Form::label('full_name', 'Họ và Tên', ['class' => 'form-label']) !!}
                    {!! Form::text('full_name', $customer->full_name ?? null, ['class' => 'form-control', 'placeholder' => 'Nhập Họ và Tên']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('username', 'Username', ['class' => 'form-label']) !!}
                    {!! Form::text('username', $customer->username ?? null, ['class' => 'form-control', 'placeholder' => 'Nhập Username']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('phone', 'Số Điện Thoại', ['class' => 'form-label']) !!}
                    {!! Form::text('phone', $customer->phone ?? null, ['class' => 'form-control', 'placeholder' => 'Nhập Số Điện Thoại']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'Email', ['class' => 'form-label']) !!}
                    {!! Form::text('email', $customer->email ?? null, ['class' => 'form-control', 'placeholder' => 'Nhập Email']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('address', 'Địa Chỉ', ['class' => 'form-label']) !!}
                    {!! Form::text('address', $customer->address ?? null, ['class' => 'form-control', 'placeholder' => 'Nhập Địa Chỉ']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('code', 'Mã Khách Hàng', ['class' => 'form-label']) !!}
                    {!! Form::text('code', $customer->code ?? null, ['class' => 'form-control', 'placeholder' => 'Nhập Mã Khách Hàng']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Cập Nhật', ['class' => 'btn btn-primary mt-1']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
