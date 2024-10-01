@extends('tracking.master')

@section('content')
    <style>
        #copyButton {
            border: none;
            background: none;
            color: #28a745;
        }

        #copyButton:hover {
            color: #218838;
        }

        .transport_status_btn {
            background-color: rgb(114, 172, 77);
            border-radius: 15px;
            border: none;
            padding: 2px 20px;
        }

        .icon-tracking {
            font-size: 30px;
            margin-right: 10px;
            padding: 10px;
            border: 2px solid #898989;
            border-radius: 8px;
        }

        #orderId {
            font-size: 18px;
        }

        .text-color-green {
            color: #28a745;
        }
    </style>
    <div class="header">
        <nav class="navbar py-4">
            <div class="container-xxl">
                @include('tracking.partials.header-right')
                <!-- main menu Search-->
                <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                    <div class="input-group flex-nowrap input-group-lg">
                        <h4>Chi Tiết Đơn Hàng</h4>
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
    <div class="container-xxl">
        <div class="row g-3 mb-3 color-bg-fff tracking-wrapper">
            <div class="col-md-12 mb-3">
                <div class="d-flex justify-content-between">
                    <div class="d-flex align-items-center">
                        <span class="icon-tracking">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="1em"
                                 height="1em" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true"
                                 focusable="false"
                                 class="">
                            <defs>
                                <clipPath id="clip-path">
                                    <rect id="Rectangle_1652" data-name="Rectangle 1652" width="16" height="16"
                                          transform="translate(8 8)" fill="#898989" stroke="#707070"
                                          stroke-width="1"></rect>
                                </clipPath>
                            </defs>
                            <g id="ic_Kygui" transform="translate(-8 -8)" clip-path="url(#clip-path)">
                                <path id="hand"
                                      d="M11.148,8.877A7.374,7.374,0,0,1,15.37,10.26l.646.462v1.537l-1.373-.982a6.129,6.129,0,0,0-3.509-1.15h-4.4a.5.5,0,0,0-.281.914,1.272,1.272,0,0,0,.361.183c.243.035,3.023.333,4.847.525l-.131,1.243c-1.42-.15-4.745-.5-4.937-.538a2.4,2.4,0,0,1-.842-.38,1.751,1.751,0,0,1-.413-.4l-.006.006-3-2.944a.625.625,0,0,0-.876.892l4.639,4.552a1.96,1.96,0,0,0,1.38.564h8.544V16H7.472a3.2,3.2,0,0,1-2.256-.922L.577,10.526A1.875,1.875,0,0,1,3.2,7.849L5.191,9.8a1.751,1.751,0,0,1,1.541-.921h4.416M4.016,5.719V1.875A1.877,1.877,0,0,1,5.891,0h5.281a1.877,1.877,0,0,1,1.875,1.875V5.719a1.877,1.877,0,0,1-1.875,1.875H5.891A1.877,1.877,0,0,1,4.016,5.719Zm1.25,0a.626.626,0,0,0,.625.625h5.281a.626.626,0,0,0,.625-.625V1.875a.626.626,0,0,0-.625-.625H5.891a.626.626,0,0,0-.625.625ZM9.7,2.5H7.328V3.75H9.7Zm0,0"
                                      transform="translate(7.984 8)" fill="#898989"></path>
                            </g>
                        </svg>
                        </span>
                        <div>
                            <div>
                                <span id="orderId" class="font-weight-bold">{{$details->package_id ?? "N/A"}}</span>
                                <button id="copyButton" title="Copy Order ID">
                                    <i class="fa fa-copy"></i>
                                </button>
                            </div>
                            <button class="transport_status_btn color-fff">
                                {{ $statusKeys[$details->status_transport] ?? "" }}
                            </button>
                        </div>
                    </div>
                </div>

                @php
                    $freightCharge = 17000
                @endphp
                <hr>

                <div>
                    <span>Cước vận chuyển quốc tế: <span class="font-weight-bold" style="color: #0067ff">{{ number_format($freightCharge, 0, ',', '.') }} VND</span></span>
                </div>

                <hr>

                <div class="container-fluid">
                    <div class="row" style="row-gap: 10px">
                        <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                            <label class="w-100 mb-0">Cân Nặng Tính Phí</label>
                            <span
                                class="text-color-green font-weight-bold">{{number_format ($details->weight , 0, ',', '.')}}</span>
                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                            <label class="w-100 mb-0">Tổng chi phí</label>
                            <span class="text-color-green font-weight-bold">{{number_format ($freightCharge * $details->weight , 0, ',', '.')}} VND</span>
                        </div>
                        <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                            <label class="w-100 mb-0">Cần thanh toán</label>
                            <span class="text-color-green font-weight-bold">{{number_format ($freightCharge * $details->weight , 0, ',', '.')}} VND</span>
                        </div>
                    </div>
                </div>

                <hr>
                <div class="col-xl-2 col-md-3 col-sm-4 col-6 p-0">
                    <label class="mb-0">Số lượng kiện: <span class="font-weight-bold">1</span></label>
                </div>

                <hr>
                <div>
                    <span>Dịch vụ: <span class="font-weight-bold">Vận chuyển hàng lẻ</span></span>
                </div>

                <hr>
                <span>Kho nhận: <span class="font-weight-bold">{{$details->warehouse->name ?? "N/A"}}</span></span>

                <hr>
                <span>Tên khách hàng: <span
                        class="font-weight-bold">{{$details->customer->full_name ?? "N/A"}}</span></span>

                <hr>
                <span>Địa chỉ giao hàng: <span class="font-weight-bold">{{$details->customer->address ?? "N/A"}}</span></span>

                <hr>
                <span>Mã khách hàng: <span class="font-weight-bold">{{$details->customer->code ?? "N/A"}}</span></span>

                <hr>
                <div class="row">
                    <div class="col-md-4">
                        <span>Mã vận đơn: </span>
                        <span class="font-weight-bold">
                                @if($details->freightBills->isNotEmpty())
                                {{ $details->freightBills->pluck('freight_bill')->implode(', ') }}
                            @else
                                N/A
                            @endif
                            </span>
                    </div>
                    <div class="col-md-3">
                        <span>Mã bao: </span>
                        <span class="font-weight-bold">{{$details->bag_id ?? 'N/A'}}</span>
                    </div>
                    <div class="col-md-4">
                        <span> Mã kiện: </span>
                        <span class="font-weight-bold">{{$details->package_code ?? 'N/A'}}</span>
                    </div>
                </div>

                <hr>
                <span>Thời gian tạo: <span
                        class="font-weight-bold">{{$details->order_create_time ?? "N/A"}}</span></span>

                <hr>
                <form method="POST" action="{{ route('admin.tracking.submit.notes', $details->id) }}">
                    @csrf
                    <div class="d-flex flex-column">
                        <span class="w-100 mb-1">Ghi chú cho đơn hàng: </span>
                        <label>
                            <textarea rows="2" placeholder="Ghi Chú" class="w-100" name="note"></textarea>
                        </label>
                    </div>
                    <button class="btn btn-primary">Gửi Ghi Chú</button>
                </form>
            </div>
        </div>
    </div>
        @endsection

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const copyButton = document.getElementById('copyButton');
                const orderId = document.getElementById('orderId').textContent.trim();

                copyButton.addEventListener('click', function () {
                    const tempInput = document.createElement('input');
                    tempInput.value = orderId;
                    document.body.appendChild(tempInput);

                    tempInput.select();
                    document.execCommand('copy');

                    document.body.removeChild(tempInput);
                });

                setTimeout(function () {
                    var successMessage = document.getElementById('success-message');
                    if (successMessage) {
                        successMessage.style.transition = 'opacity 0.5s ease';
                        successMessage.style.opacity = '0';
                        setTimeout(function() {
                            successMessage.remove();
                        }, 500);
                    }
                }, 3000);
            });

            document.addEventListener('DOMContentLoaded', function () {
                // Set a timeout to hide the success message after 3 seconds

            });
        </script>
