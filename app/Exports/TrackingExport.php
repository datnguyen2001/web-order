<?php

namespace App\Exports;

use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class TrackingExport implements FromCollection, WithHeadings, WithCustomCsvSettings, WithMapping, Responsable
{
    use Exportable;

    private $trackingOrders;

    public function __construct($trackingOrders)
    {
        $this->trackingOrders = $trackingOrders;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->trackingOrders;
    }

    public function map($row): array
    {
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

        // Reverse the array to map the value back to the key
        $statusKeys = array_flip($statuses);
        $statusKey = $statusKeys[$row->status_transport] ?? $row->status_transport;

        $freightBills = $row->freightBills->pluck('freight_bill')->unique()->all();
        $freightCharge = 17000;

        return [
            $row->package_id,
            $statusKey, // Export the key corresponding to the status
            $row->customer->full_name ?? '',
            $row->warehouse->name ?? '',
            implode(", ", $freightBills), // Combine unique freight_bills into a single string
            $row->bag_id,
            $row->order_id,
            $freightCharge * $row->weight,
            $row->order_create_time,
            $row->weight,
        ];
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => ',',
            'enclosure' => '"',
        ];
    }

    public function headings(): array
    {
        return [
            "Mã kiện",
            "Trạng thái",
            "Khách hàng",
            "Kho nhận",
            "Mã vận đơn",
            "Mã bao",
            "Mã kiện",
            "Tổng chi phí",
            "Thời gian",
            "Cân nặng"
        ];
    }
}
