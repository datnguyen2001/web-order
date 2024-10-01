<?php

namespace App\Http\Controllers\tracking;

use App\Models\Customer;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        parent::__construct();

        $this->customerRepository = $customerRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->per_page ?? 10;

        $customers = $this->customerRepository->getALlCustomers($request, $perPage, false);

        return view('tracking.customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::withTrashed()->findOrFail($id);

        return view('tracking.customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $customers = $this->customerRepository->update($input, $id);

        session()->flash('success', 'Cập Nhật Khách Hàng Thành Công!');

        return redirect(route('admin.tracking.customer.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $customer = Customer::where('id', $id)->first();

        $this->customerRepository->delete($customer->id);

        session()->flash('success', 'Xoá Khách Hàng Thành Công!');

        return redirect(route('admin.tracking.customer.index'));
    }

}
