<style>
    .tracking-wrapper {
        margin: 0 15px;
        border-radius: 10px;
    }

    .tracking-wrapper hr {
        margin: 10px 0;
    }

    .text-color-green {
        color: #28a745;
    }
    #copyButton{
        border: none;
        background: none;
        color: #28a745;
    }
    #copyButton:hover{
        color: #218838;
    }
    .transport_status_btn {
        background-color: rgb(114, 172, 77);
        border-radius: 15px;
        border: none;
        padding: 2px 20px;
    }
</style>

<div class="body d-flex py-3">
    <div class="container-xxl tracking-field">
        <div class="title d-flex flex-wrap justify-content-between">
            <h5 class="mb-0">Danh sách đơn ký gửi</h5>
            <form action="{{ route('admin.tracking.home.export') }}" method="GET">
                <!-- Include all current search parameters as hidden fields -->
                <input type="hidden" name="freight_bill" value="{{ request('freight_bill') }}">
                <input type="hidden" name="create_time_from" value="{{ request('create_time_from') }}">
                <input type="hidden" name="create_time_to" value="{{ request('create_time_to') }}">
                <input type="hidden" name="package_id" value="{{ request('package_id') }}">
                <input type="hidden" name="order_id" value="{{ request('order_id') }}">
                <input type="hidden" name="bag_id" value="{{ request('bag_id') }}">
                <input type="hidden" name="customer_name" value="{{ request('customer_name') }}">
                <input type="hidden" name="warehouse_id" value="{{ request('warehouse_id') }}">
                <input type="hidden" name="statuses" value="{{ request('statuses') }}">

                <button type="submit" class="btn btn-secondary mr-3">Xuất Excel</button>
            </form>

        </div>
        <hr>
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
            $statusKeys = array_flip($statuses);
        @endphp
        @if(!empty($trackingOrders) && count($trackingOrders) > 0)
            @foreach($trackingOrders as $trackingOrder)
                <div class="row g-3 mb-3 color-bg-fff tracking-wrapper">
                    <div class="col-md-12 mb-3">
                        <div class="d-flex flex-wrap justify-content-between">
                            <div class="d-flex flex-wrap align-items-center mb-2">
                                <span class="text-color-green font-weight-bold d-flex align-items-center">
                                    <a href="{{route('admin.tracking.home.details', ($trackingOrder->id))}}" class="text-color-green">
                                        <span id="orderId">{{$trackingOrder->package_id ?? "N/A"}}</span>
                                    </a>
                                    <button id="copyButton" title="Copy Order ID">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </span>
                                <span>| Khách hàng:</span>
                                <span class="warehouse font-weight-bold ml-2 mr-2">{{$trackingOrder->customer->full_name ?? "N/A"}}</span>
                                <span>| Kho nhận:</span>
                                <span class="warehouse font-weight-bold ml-2">{{$trackingOrder->warehouse->name ?? "N/A"}}</span>
                            </div>
                            <button class="transport_status_btn color-fff">
                                {{ $statusKeys[$trackingOrder->status_transport] ?? "" }}
                            </button>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <span>Mã vận đơn: </span>
                                <span class="font-weight-bold">
                                @if($trackingOrder->freightBills->isNotEmpty())
                                        {{ $trackingOrder->freightBills->pluck('freight_bill')->implode(', ') }}
                                    @else
                                        N/A
                                    @endif
                            </span>
                            </div>
                            <div class="col-md-3">
                                <span>Mã bao: </span>
                                <span class="font-weight-bold">{{$trackingOrder->bag_id ?? 'N/A'}}</span>
                            </div>
                            <div class="col-md-4">
                                <span> Mã kiện: </span>
                                <span class="font-weight-bold">{{$trackingOrder->package_code ?? 'N/A'}}</span>
                            </div>
                        </div>
                        <hr>
                        @php
                            $freightCharge = 17000;
                        @endphp
                        <div>
                            <span>Cước Vận Chuyển Quốc Tế: <span class="font-weight-bold" style="color: #0067ff">{{ number_format($freightCharge, 0, ',', '.') }} VND</span></span>
                        </div>
                        <hr>
                        <div>
                            <span>Dịch vụ: <span class="font-weight-bold">Vận chuyển hàng lẻ</span></span>
                        </div>
                        <hr>
                        <div class="container-fluid">
                            <div class="row" style="row-gap: 10px">
                                <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                                    <label class="w-100 mb-0">Tổng tiền hàng</label>
                                    <span class="text-color-green font-weight-bold">{{number_format ($freightCharge * $trackingOrder->weight , 0, ',', '.')}} VND</span>
                                </div>
                                <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                                    <label class="w-100 mb-0">Tổng chi phí</label>
                                    <span class="text-color-green font-weight-bold">{{number_format ($freightCharge * $trackingOrder->weight , 0, ',', '.')}} VND</span>
                                </div>
                                <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                                    <label class="w-100 mb-0">Cần thanh toán</label>
                                    <span class="text-color-green font-weight-bold">{{number_format ($freightCharge * $trackingOrder->weight , 0, ',', '.')}} VND</span>
                                </div>
                                <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                                    <label class="w-100 mb-0">Thời gian</label>
                                    <span class="font-weight-bold">
                                    {{ $trackingOrder->order_create_time ? Carbon\Carbon::parse($trackingOrder->order_create_time)->format('H:i d/m/Y') : 'N/A' }}
                                </span>
                                </div>
                                <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                                    <label class="w-100 mb-0">Số lượng kiện</label>
                                    <span class="font-weight-bold">1</span>
                                </div>
                                <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                                    <label class="w-100 mb-0">Cân nặng tính phí</label>
                                    <span class="font-weight-bold">{{$trackingOrder->weight ?? '0'}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if (!empty($trackingOrders) && $trackingOrders->total() > ($request['per_page'] ?? 10))
                <div class="d-flex justify-content-center">
                    {{ $trackingOrders->appends(request()->all())->links('admin.pagination_custom.index') }}
                </div>
            @endif
        @else
            Không Tìm Thấy Kết Quả
        @endif


    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const copyButton = document.getElementById('copyButton');
        const orderId = document.getElementById('orderId').textContent.trim();

        copyButton.addEventListener('click', function() {
            const tempInput = document.createElement('input');
            tempInput.value = orderId;
            document.body.appendChild(tempInput);

            tempInput.select();
            document.execCommand('copy');

            document.body.removeChild(tempInput);
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Copy all search form values to export form when search form is submitted
        document.getElementById('searchForm').addEventListener('submit', function () {
            const exportForm = document.querySelector('form[action="{{ route('admin.tracking.home.export') }}"]');

            // Loop through all the search form elements and append them to the export form
            const elements = this.elements;
            for (let i = 0; i < elements.length; i++) {
                const element = elements[i];
                if (element.name) {
                    // Check if element already exists in the export form
                    let exportElement = exportForm.querySelector(`input[name="${element.name}"]`);
                    if (!exportElement) {
                        // Create a hidden input element for the export form
                        exportElement = document.createElement('input');
                        exportElement.type = 'hidden';
                        exportElement.name = element.name;
                        exportForm.appendChild(exportElement);
                    }
                    // Set the value
                    exportElement.value = element.value;
                }
            }
        });
    });
</script>
