<style>
    .col {
        flex-grow: 0 !important;
    }
    .alert {
        padding: 6px 10px !important;
    }
    .search-field, .tracking-field {
        border: 1px solid #f3f3f3;
        background: #f3f3f3;
        padding: 20px 0 0 20px;
        border-radius: 15px;
    }
    .search-field .row {
        margin-right: 0;
        margin-left: 0;
    }
    .search-field .row > * {
        padding-left: 0;
    }
    .status-btn{
        cursor: pointer;
    }
    .status-btn:hover{
        background-color: #28a745;
    }
    .status-btn.selected {
        background-color: #28a745;
        color: white;
    }
</style>

<form id="searchForm" method="GET" action="{{route('admin.tracking.home.index')}}">
    <div class="body d-flex py-3">
        <div class="container-xxl search-field">
            <div class="title mb-4">
                <h6 class="text-decoration-underline">Trạng Thái: </h6>
            </div>
            @php
                $statuses = [
                    'Đã Ký Gửi' => 'ACCEPTED',
                    'Chờ Duyệt' => 'PENDING',
                    'Người Bán Giao' => 'MERCHANT_DELIVERING',
                    'Hàng Về Kho TQ' => 'PUTAWAY',
                    'Vận Chuyển Quốc Tế' => 'TRANSPORTING',
                    'Chờ Giao' => 'READY_FOR_DELIVERY',
                    'Đang Giao' => 'DELIVERING',
                    'Đã Nhận Hàng' => 'DELIVERED',
                    'Đã Huỷ' => 'CANCELLED',
                    'Thất Lạc' => 'MIA',
                    'Không Nhận Hàng' => 'DELIVERY_CANCELLED',
                ];
            @endphp
            <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4" style="gap: 10px">
                @foreach ($statuses as $label => $name)
                    <div class="col p-0 mt-0">
                        <div class="alert-success alert mb-0 status-btn" data-name="{{ $name }}">
                            <div class="d-flex align-items-center">
                                <div class="flex-fill text-truncate">
                                    <div class="h6 mb-0">{{ $label }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <input type="hidden" name="statuses" id="selectedStatuses" value="{{ request()->statuses }}">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('freight_bill', 'Mã Vận Đơn', ['class' => 'form-label']) !!}
                        {!! Form::text('freight_bill', old('freight_bill', request()->freight_bill), ['class' => 'form-control', 'placeholder' => 'Mã Vận Đơn']) !!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {!! Form::label('create_time', 'Thời gian tạo:', ['class' => 'form-label']) !!}
                        <div class="row">
                            <div class="col-md-6 p-0">
                                {!! Form::date('create_time_from', old('create_time_from', request()->create_time_from), ['class' => 'form-control', 'placeholder' => 'Bắt Đầu']) !!}
                            </div>
                            <div class="col-md-6 p-0">
                                {!! Form::date('create_time_to', old('create_time_to', request()->create_time_to), ['class' => 'form-control', 'placeholder' => 'Kết Thúc']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="moreFields" style="display: none;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('package_id', 'Mã Kiện', ['class' => 'form-label']) !!}
                            {!! Form::text('package_id', old('package_id', request()->package_id), ['class' => 'form-control', 'placeholder' => 'Mã Kiện']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('order_id', 'Mã Đơn Hàng', ['class' => 'form-label']) !!}
                            {!! Form::text('order_id', old('order_id', request()->order_id), ['class' => 'form-control', 'placeholder' => 'Mã Đơn Hàng']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('bag_id', 'Mã Bao', ['class' => 'form-label']) !!}
                            {!! Form::text('bag_id', old('bag_id', request()->bag_id), ['class' => 'form-control', 'placeholder' => 'Mã Bao']) !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('customer_name', 'Tên Khách Hàng', ['class' => 'form-label']) !!}
                            {!! Form::text('customer_name', old('customer_name', request()->customer_name), ['class' => 'form-control', 'placeholder' => 'Tên Khách Hàng']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('warehouse_id', 'Kho Đích', ['class' => 'form-label']) !!}
                            {!! Form::text('warehouse_id', old('warehouse_id', request()->warehouse_id), ['class' => 'form-control', 'placeholder' => 'Kho Đích']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-2 mb-3" style="padding-right: 15px">
                <button type="button" id="toggleButton" class="btn btn-success">Xem Thêm</button>
                <div class="d-flex align-items-center">
                    <div>
                        <i class="icofont-spinner-alt-3"></i>
                        <a id="refreshButton" href="#" class="color-000 mr-3 refresh-btn">Làm mới bộ lọc</a>
                    </div>
                    <button type="submit" class="btn btn-info" >Tìm Kiếm</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.getElementById('toggleButton');
        const moreFields = document.getElementById('moreFields');
        const refreshButton = document.getElementById('refreshButton');
        const formInputs = document.querySelectorAll('.search-field input');
        const statusButtons = document.querySelectorAll('.status-btn');
        const selectedStatusesInput = document.getElementById('selectedStatuses');
        const searchForm = document.getElementById('searchForm');

        // Toggle visibility of moreFields
        toggleButton.addEventListener('click', function() {
            if (moreFields.style.display === 'none') {
                moreFields.style.display = 'block';
                toggleButton.textContent = 'Ẩn Bớt';
            } else {
                moreFields.style.display = 'none';
                toggleButton.textContent = 'Xem Thêm';
            }
        });

        // Refresh button to clear all input fields
        refreshButton.addEventListener('click', function(event) {
            event.preventDefault();
            formInputs.forEach(function(input) {
                input.value = '';
            });
            statusButtons.forEach(function(button) {
                button.classList.remove('selected');
            });
            selectedStatusesInput.value = '';
        });

        // Toggle selection of status buttons
        statusButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                button.classList.toggle('selected');
                updateSelectedStatuses();
            });
        });

        // Update the hidden input with selected statuses
        function updateSelectedStatuses() {
            const selectedStatuses = [];
            statusButtons.forEach(function(button) {
                if (button.classList.contains('selected')) {
                    selectedStatuses.push(button.getAttribute('data-name'));
                }
            });
            selectedStatusesInput.value = selectedStatuses.join(',');
        }

        // Maintain selected statuses on page load
        const currentStatuses = selectedStatusesInput.value.split(',');
        statusButtons.forEach(function(button) {
            if (currentStatuses.includes(button.getAttribute('data-name'))) {
                button.classList.add('selected');
            }
        });

        // Remove empty fields before form submission
        searchForm.addEventListener('submit', function(event) {
            const formElements = searchForm.elements;
            for (let i = formElements.length - 1; i >= 0; i--) {
                const element = formElements[i];
                if (element.tagName === 'INPUT' && element.type !== 'hidden' && element.value.trim() === '') {
                    element.parentNode.removeChild(element);
                }
            }
        });
    });
</script>


