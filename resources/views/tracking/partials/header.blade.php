<div class="header">
    <nav class="navbar py-4">
        <div class="container-xxl">
            @include('tracking.partials.header-right')

            <!-- main menu Search-->
            <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                <div class="input-group flex-nowrap input-group-lg align-items-center">
                    <a href="{{route('admin.index')}}">
                        <img src="{{asset('assets/tracking/images/back-icon.png')}}" alt="Back" width="24" height="24" class="mr-2"/>
                    </a>
                    <h4 class="mb-0">Danh sách đơn ký gửi</h4>
                </div>
            </div>

        </div>
    </nav>
</div>
