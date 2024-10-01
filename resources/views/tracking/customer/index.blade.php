@extends('tracking.master')

@section('content')
    <div class="header">
        <nav class="navbar py-4">
            <div class="container-xxl">
                @include('tracking.partials.header-right')
                <!-- main menu Search-->
                <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                    <div class="input-group flex-nowrap input-group-lg">
                        <h4>Danh Sách Khách Hàng</h4>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    @if(session('success'))
        <div class="alert alert-success" id="success-message">
            {{ session('success') }}
        </div>
    @endif
    <div class="container-xxl">
        @include('tracking.customer.partials.index-table')
    </div>
@endsection
