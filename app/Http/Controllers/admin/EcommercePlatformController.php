<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EcommercePlatformModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EcommercePlatformController extends Controller
{
    public function index(Request $request)
    {
        $titlePage = 'Danh sách sàn TMDT';
        $page_menu = 'e-commerce-platform';
        $page_sub = null;
        $listData = EcommercePlatformModel::orderBy('created_at', 'desc')->paginate(10);

        return view('admin.ecommerce.index', compact('titlePage', 'page_menu', 'page_sub', 'listData'));
    }

    public function create ()
    {
        try{
            $titlePage = 'Thêm sàn TMDT';
            $page_menu = 'e-commerce-platform';
            $page_sub = null;
            return view('admin.ecommerce.create', compact('titlePage', 'page_menu', 'page_sub'));
        }catch (\Exception $e){
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function store (Request $request)
    {
        try{
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $imagePath = Storage::url($file->store('banner', 'public'));
            }else{
                return back()->with(['info'=>'Vui lòng thêm ảnh để tiếp tục']);
            }
            if ($request->get('display') == 'on'){
                $display = 1;
            }else{
                $display = 0;
            }
            $ecommerce = new EcommercePlatformModel([
                'link' => $request->get('link'),
                'display' => $display,
                'src' => $imagePath,
                'name'=>$request->get('name')
            ]);
            $ecommerce->save();
            return redirect()->route('admin.e-commerce-platform.index')->with(['success' => 'Tạo sàn TMDT thành công']);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function delete ($id)
    {
        $ecommerce = EcommercePlatformModel::find($id);
        if (isset($ecommerce->src) && Storage::exists(str_replace('/storage', 'public', $ecommerce->src))) {
            Storage::delete(str_replace('/storage', 'public', $ecommerce->src));
        }
        $ecommerce->delete();
        return redirect()->route('admin.e-commerce-platform.index')->with(['success'=>"Xóa dữ liệu thành công"]);
    }

    public function edit ($id)
    {
        try{
            $ecommerce = EcommercePlatformModel::find($id);
            if (empty($ecommerce)) {
                return back()->with(['error' => 'Sàn không tồn tại']);
            }
            $titlePage = 'Sửa sàn TMDT';
            $page_menu = 'e-commerce-platform';
            $page_sub = null;
            return view('admin.ecommerce.edit', compact('titlePage', 'page_menu', 'page_sub', 'ecommerce'));
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function update ($id, Request $request)
    {
        try{
            $ecommerce = EcommercePlatformModel::find($id);
            if (empty($ecommerce)){
                return back()->with(['error' => 'Sàn không tồn tại']);
            }
            if ($request->hasFile('file')){
                $file = $request->file('file');
                $imagePath = Storage::url($file->store('banner', 'public'));
                if (isset($banner->src) && Storage::exists(str_replace('/storage', 'public', $ecommerce->src))) {
                    Storage::delete(str_replace('/storage', 'public', $ecommerce->src));
                }
                $ecommerce->src = $imagePath;
            }
            if ($request->get('display') == 'on'){
                $display = 1;
            }else{
                $display = 0;
            }
            $ecommerce->name = $request->get('name');
            $ecommerce->link = $request->get('link');
            $ecommerce->display = $display;
            $ecommerce->save();
            return redirect()->route('admin.e-commerce-platform.index')->with(['success' => 'Cập nhật sàn TMDT thành công']);
        }catch (\Exception $e){
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}
