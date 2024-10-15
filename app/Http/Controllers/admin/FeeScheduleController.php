<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\FeeScheduleModel;
use Illuminate\Http\Request;

class FeeScheduleController extends Controller
{
    public function index()
    {
        $titlePage = 'Biểu phí';
        $page_menu = 'fee_schedule';
        $page_sub = null;
        $data = FeeScheduleModel::first();

        return view('admin.fee_schedule.index',compact('titlePage','page_menu','page_sub','data'));
    }

    public function save(Request $request){
        $fee = FeeScheduleModel::first();
        if ($fee){
            $fee->content = $request->get('content');
            $fee->save();
        }else{
            $fee = new FeeScheduleModel([
                'content'=>$request->get('content'),
            ]);
            $fee->save();
        }

        return redirect()->back()->with(['success'=>"Lưu thông tin thành công"]);
    }
}
