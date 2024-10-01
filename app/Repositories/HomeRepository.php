<?php

namespace App\Repositories;

use App\Models\TrackingOrder;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Illuminate\Support\Facades\Auth;

class HomeRepository extends AppBaseRepository
{
    public function model()
    {
        return TrackingOrder::class;
    }

    public function getAllTrackingOrder(Request $request, $perPage = 10, $archived = false, $getAll = false)
    {
        $this->scopeQuery(function ($query) use ($request, $perPage, $archived) {
            // Check the user's role
//            $user = Auth::user();
            $query = $query->with('freightBills');
//                $query = $query->where('customer_id', $user->customer_id)->with('freightBills');

            if ($request->has('freight_bill') && $request->freight_bill != null) {
                $query = $query->whereHas('freightBills', function ($q) use ($request) {
                    $q->where('freight_bill', 'like', '%' . $request->freight_bill . '%');
                });
            }

            if ($request->has('create_time_from') && $request->create_time_from != null) {
                $query = $query->whereDate('order_create_time', '>=', $request->create_time_from);
            }

            if ($request->has('create_time_to') && $request->create_time_to != null) {
                $query = $query->whereDate('order_create_time', '<=', $request->create_time_to);
            }

            if ($request->has('package_id') && $request->package_id != null) {
                $query = $query->where('package_id', 'like', '%' . $request->package_id . '%');
            }

            if ($request->has('order_id') && $request->order_id != null) {
                $query = $query->where('order_id', 'like', '%' . $request->order_id . '%');
            }

            if ($request->has('bag_id') && $request->bag_id != null) {
                $query = $query->where('bag_id', 'like', '%' . $request->bag_id . '%');
            }

            if ($request->has('customer_name') && $request->customer_name != null) {
                $query = $query->whereHas('customer', function ($q) use ($request) {
                    $q->where('full_name', 'like', '%' . $request->customer_name . '%');
                });
            }

            if ($request->has('warehouse_id') && $request->warehouse_id != null) {
                $query = $query->whereHas('warehouse', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->warehouse_id . '%');
                });
            }

            if ($request->has('statuses') && $request->statuses != null) {
                $statuses = explode(',', $request->statuses);
                $query = $query->whereIn('status_transport', $statuses);
            }

            return $query;
        });

        $this->pushCriteria(app(RequestCriteria::class));
        if($getAll === true) {
            $tracking = $this->get();

        } else {
            $tracking = $this->paginate($perPage);
        }
        return $tracking;
    }
}
