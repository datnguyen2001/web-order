<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\AddressModel;
use App\Models\DistrictModel;
use App\Models\ProvinceModel;
use App\Models\WardModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function district($province_id){
        try{
            $data = DistrictModel::where('province_id',$province_id)->get();
            return response()->json(['message'=>'Lấy thông tin thành công','data'=>$data,'status'=>true]);
        }catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(),'status'=>false]);
        }
    }

    public function wards($district_id){
        try{
            $data = WardModel::where('district_id',$district_id)->get();
            return response()->json(['message'=>'Lấy thông tin thành công','data'=>$data,'status'=>true]);
        }catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(),'status'=>false]);
        }
    }

    public function saveAddress(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|digits_between:10,11',
                'detail_address' => 'required|string|max:255',
            ], [
                'name.required' => 'Tên người nhận không được bỏ trống.',
                'name.string' => 'Tên người nhận phải là chuỗi ký tự.',
                'name.max' => 'Tên người nhận không được quá :max ký tự.',
                'phone.required' => 'Số điện thoại không được bỏ trống.',
                'phone.numeric' => 'Số điện thoại phải là số.',
                'phone.digits_between' => 'Số điện thoại phải có từ :min đến :max chữ số.',
                'detail_address.required' => 'Địa chỉ cụ thể không được bỏ trống.',
                'detail_address.string' => 'Địa chỉ cụ thể phải là chuỗi ký tự.',
                'detail_address.max' => 'Địa chỉ cụ thể không được quá :max ký tự.',
            ]);

            $is_default = 1;
            if ($request->is_default == 'on'){
                AddressModel::where('user_id', Auth::id())
                    ->where('is_default', 1)
                    ->update(['is_default' => 0]);
            }

            $address = new AddressModel();
            $address->user_id = Auth::id();
            $address->name = $request->get('name');
            $address->phone = $request->get('phone');
            $address->province_id = $request->get('province_id');
            $address->district_id = $request->get('district_id');
            $address->ward_id = $request->get('ward_id');
            $address->detail_address = $request->get('detail_address');
            $address->is_default = $is_default;
            $address->save();

            return response()->json(['message'=>'Thêm địa chỉ thành công','status'=>true]);
        }catch (\Exception $e){
            return response()->json(['message'=>$e->getMessage(),'status'=>false]);
        }
    }

    public function addressNew(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|digits_between:10,11',
                'detail_address' => 'required|string|max:255',
            ], [
                'name.required' => 'Tên người nhận không được bỏ trống.',
                'name.string' => 'Tên người nhận phải là chuỗi ký tự.',
                'name.max' => 'Tên người nhận không được quá :max ký tự.',
                'phone.required' => 'Số điện thoại không được bỏ trống.',
                'phone.numeric' => 'Số điện thoại phải là số.',
                'phone.digits_between' => 'Số điện thoại phải có từ :min đến :max chữ số.',
                'detail_address.required' => 'Địa chỉ cụ thể không được bỏ trống.',
                'detail_address.string' => 'Địa chỉ cụ thể phải là chuỗi ký tự.',
                'detail_address.max' => 'Địa chỉ cụ thể không được quá :max ký tự.',
            ]);

            $is_default = 0;
            if ($request->is_default == 'on'){
                $is_default = 1;
                AddressModel::where('user_id', Auth::id())
                    ->where('is_default', 1)
                    ->update(['is_default' => 0]);
            }

            $address = new AddressModel();
            $address->user_id = Auth::id();
            $address->name = $request->get('name');
            $address->phone = $request->get('phone');
            $address->province_id = $request->get('province_id');
            $address->district_id = $request->get('district_id');
            $address->ward_id = $request->get('ward_id');
            $address->detail_address = $request->get('detail_address');
            $address->is_default = $is_default;
            $address->save();

            toastr()->success('Thêm địa chỉ thành công');
            return back();
        }catch (\Exception $e){
            toastr()->error($e->getMessage());
            return back();
        }
    }

    public function updateDefaultAddress(Request $request)
    {
        AddressModel::where('user_id', Auth::id())->update(['is_default' => 0]);
        AddressModel::where('id', $request->input('id'))->update(['is_default' => 1]);

        return response()->json(['status' => true,'message'=>'Cập nhật địa chỉ mặc định thành công']);
    }

    public function editAddress(Request $request)
    {
        $provinceId = $request->query('province_id');
        $districtId = $request->query('district_id');
        $provinces = ProvinceModel::all();

        $districts = [];
        if ($provinceId) {
            $districts = DistrictModel::where('province_id', $provinceId)->get();
        }

        $wards = [];
        if ($districtId) {
            $wards = WardModel::where('district_id', $districtId)->get();
        }

        return response()->json([
            'provinces' => $provinces,
            'districts' => $districts,
            'wards' => $wards
        ]);
    }

    public function updateAddress(Request $request){
        try{
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|numeric|digits_between:10,11',
                'detail_address' => 'required|string|max:255',
            ], [
                'name.required' => 'Tên người nhận không được bỏ trống.',
                'name.string' => 'Tên người nhận phải là chuỗi ký tự.',
                'name.max' => 'Tên người nhận không được quá :max ký tự.',
                'phone.required' => 'Số điện thoại không được bỏ trống.',
                'phone.numeric' => 'Số điện thoại phải là số.',
                'phone.digits_between' => 'Số điện thoại phải có từ :min đến :max chữ số.',
                'detail_address.required' => 'Địa chỉ cụ thể không được bỏ trống.',
                'detail_address.string' => 'Địa chỉ cụ thể phải là chuỗi ký tự.',
                'detail_address.max' => 'Địa chỉ cụ thể không được quá :max ký tự.',
            ]);

            $is_default = 0;
            if ($request->is_default == 'on'){
                $is_default = 1;
                AddressModel::where('user_id', Auth::id())
                    ->where('is_default', 1)
                    ->update(['is_default' => 0]);
            }

            $address = AddressModel::where('user_id',Auth::id())->first();
            $address->name = $request->get('name');
            $address->phone = $request->get('phone');
            $address->province_id = $request->get('province_id');
            $address->district_id = $request->get('district_id');
            $address->ward_id = $request->get('ward_id');
            $address->detail_address = $request->get('detail_address');
            $address->is_default = $is_default;
            $address->save();

            toastr()->success('Cập nhật địa chỉ thành công');
            return back();
        }catch (\Exception $e){
            toastr()->success($e->getMessage());
            return back();
        }
    }

}
