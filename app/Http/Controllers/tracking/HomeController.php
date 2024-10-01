<?php

namespace App\Http\Controllers\tracking;

use App\Exports\TrackingExport;
use App\Models\TrackingOrder;
use App\Repositories\HomeRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $homeRepository;

    public function __construct(HomeRepository $homeRepository)
    {
        parent::__construct();

        $this->homeRepository = $homeRepository;
    }

    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 10;

        $trackingOrders = $this->homeRepository->getAllTrackingOrder($request, $perPage, false, false);

        return view('tracking.index', compact('trackingOrders'));
    }

    public function exportExcel(Request $request)
    {
        $trackingOrders = $this->homeRepository->getAllTrackingOrder($request, null, false, true);

        return (new TrackingExport($trackingOrders))->download('tracking_order.xlsx');
    }
    public function show($id = null)
    {
        $details = TrackingOrder::withTrashed()->findOrFail($id);

        return view('tracking.show', compact('details'));
    }

    public function submitNote(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'note' => 'nullable|string',
        ]);

        $trackingOrder = TrackingOrder::withTrashed()->findOrFail($id);

        $trackingOrder->note = $request->input('note');
        $trackingOrder->save();

        return redirect()->back()->with('success', 'Ghi chú đã được cập nhật thành công!');
    }

    public function updateOrderStatus()
    {
        return view('tracking.update-order-status');
    }

}
