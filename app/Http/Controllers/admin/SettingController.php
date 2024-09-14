<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\SettingModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $titlePage = 'Cài đặt';
        $page_menu = 'setting';
        $page_sub = null;
        $data = SettingModel::first();

        return view('admin.setting.index',compact('titlePage','page_menu','page_sub','data'));
    }

    public function save(Request $request){
        $setting = SettingModel::first();
        if ($setting){
            if ($request->hasFile('file')){
                $file = $request->file('file');
                $imagePath = Storage::url($file->store('banner', 'public'));
                if (isset($setting->logo) && Storage::exists(str_replace('/storage', 'public', $setting->logo))) {
                    Storage::delete(str_replace('/storage', 'public', $setting->logo));
                }
                $setting->logo = $imagePath;
            }

            if ($request->hasFile('img_qr')){
                $file = $request->file('img_qr');
                $imageQr = Storage::url($file->store('banner', 'public'));
                if (isset($setting->image_address) && Storage::exists(str_replace('/storage', 'public', $setting->img_qr))) {
                    Storage::delete(str_replace('/storage', 'public', $setting->img_qr));
                }
                $setting->img_qr = $imageQr;
            }

            $setting->exchange_rate = $request->get('exchange_rate');
            $setting->about_shop = $request->get('about_shop');
            $setting->facebook = $request->get('facebook');
            $setting->tiktok = $request->get('tiktok');
            $setting->youtube = $request->get('youtube');
            $setting->content_footer_one = $request->get('content_footer_one');
            $setting->content_footer_two = $request->get('content_footer_two');
            $setting->save();
        }else{
            $imagePath = null;
            if ($request->hasFile('file')){
                $file = $request->file('file');
                $imagePath = Storage::url($file->store('banner', 'public'));
            }
            if ($request->hasFile('img_qr')){
                $file = $request->file('img_qr');
                $imageQr = Storage::url($file->store('banner', 'public'));
            }
            $setting = new SettingModel([
                'exchange_rate'=>$request->get('exchange_rate'),
                'about_shop'=>$request->get('about_shop'),
                'facebook'=>$request->get('facebook'),
                'logo'=>$imagePath,
                'img_qr'=>$imageQr,
                'tiktok'=>$request->get('tiktok'),
                'youtube'=>$request->get('youtube'),
                'content_footer_one'=>$request->get('content_footer_one'),
                'content_footer_two'=>$request->get('content_footer_two'),
            ]);
            $setting->save();
        }

        return redirect()->back()->with(['success'=>"Lưu thông tin thành công"]);
    }
}
