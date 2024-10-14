<?php

namespace App\Http\Controllers\tracking;

use App\Models\Customer;
use App\Models\FreightBill;
use App\Models\ShippingPartner;
use App\Models\TrackingOrder;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{
    public function getPackage(Request $request)
    {
        $createdAtFrom = $request->input('created_at_from');
        $createdAtTo = $request->input('created_at_to');
        try {
            $fromDate = Carbon::parse($createdAtFrom);
            $toDate = Carbon::parse($createdAtTo);
        } catch (\Exception $e) {
            toastr()->error('Định dạng ngày tháng không đúng');
            return back();
        }

        if ($fromDate->diffInDays($toDate) > 32) {
            toastr()->error('Thời gian không quá 32 ngày');
            return back();
        }

        // Construct the URL with query parameters
        $url = env('API_LOGISTICS_AGENCY_URL') . '/packages';
        $authToken = env('API_LOGISTICS_AGENCY_KEY');

        // Call the external API
        try {
            $response = Http::withHeaders([
                'Authorization' => "Bearer $authToken"
            ])->get($url, [
                'created_at_from' => $createdAtFrom,
                'created_at_to' => $createdAtTo
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['packages']) && is_array($data['packages'])) {
                    foreach ($data['packages'] as $package) {
                        TrackingOrder::updateOrCreate(
                            ['package_id' => $package['id'] ?? null],
                            [
                                'package_code' => $package['code'] ?? null,
                                'status_transport' => $package['status_transport'] ?? null,
                                'weight' => $package['weight_net'] ?? null,
                                'warehouse_id' => $package['id_warehouse_current'] ?? null,
                                'customer_id' => $package['customer']['id'] ?? null,
                                'order_id' => $package['order']['id'] ?? null,
                                'order_code' => $package['order']['code'] ?? null,
                                'order_create_time' => Carbon::parse($package['created_at'])->toDateTimeString() ?? null,
                                'bag_id' => $package['bag']['id'] ?? null
                            ]
                        );

                        Customer::firstOrCreate(
                            ['customers_id' => $package['customer']['id'] ?? null],
                            [
                                'agency_id' => $package['customer']['id_agency'] ?? null,
                                'code' => $package['customer']['code'] ?? null,
                                'username' => $package['customer']['username'] ?? null,
                                'address' => $package['customer']['address'] ?? null,
                                'email' => $package['customer']['email'] ?? null,
                                'full_name' => $package['customer']['full_name'] ?? null,
                                'phone' => $package['customer']['phone'] ?? null,
                                'type' => $package['customer']['type'] ?? null,
                            ]
                        );

                        ShippingPartner::updateOrCreate(
                            ['partner_id' => $package['shipping_partners']['id'] ?? null],
                            [
                                'name' => $package['shipping_partners']['name'] ?? null,
                                'code' => $package['shipping_partners']['code'] ?? null,
                                'address' => $package['shipping_partners']['address'] ?? null,
                            ]
                        );

                        if (isset($package['order']['freight_bills']) && is_array($package['order']['freight_bills'])) {
                            foreach ($package['order']['freight_bills'] as $freightBill) {
                                FreightBill::updateOrCreate(
                                    ['package_id' => $package['id'], 'freight_bill' => $freightBill['freight_bill']],
                                    []
                                );
                            }
                        }
                    }
                    toastr()->success('Cập nhật trạng thái thành công');
                    return back();
                } else {
                    toastr()->error('Cập nhật trạng thái thất bại');
                    return back();
                }
            }else {
                toastr()->error('Không thể lấy trạng thái đơn hàng');
                return back();
            }
        } catch (\Exception $e) {
            toastr()->error('Có lỗi xảy ra, vui lòng thử lại:');
            return back();
        }
    }
}
