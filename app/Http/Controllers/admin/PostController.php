<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\PostModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $titlePage = 'Danh sách bài viết';
        $page_menu = 'post';
        $page_sub = null;
        $listData = PostModel::orderBy('created_at', 'desc')->paginate(15);

        return view('admin.post.index', compact('titlePage', 'page_menu', 'page_sub', 'listData'));
    }

    public function create ()
    {
        try{
            $titlePage = 'Thêm bài viết';
            $page_menu = 'post';
            $page_sub = null;
            return view('admin.post.create', compact('titlePage', 'page_menu', 'page_sub'));
        }catch (\Exception $e){
            return back()->with(['error' => $e->getMessage()]);
        }
    }

    public function store (Request $request)
    {
        try{
            $information = new PostModel([
                'name' => $request->get('name'),
                'slug' => Str::slug($request->get('name')),
                'content' => $request->get('content'),
                'type' => $request->get('type'),
            ]);
            $information->save();
            return redirect()->route('admin.post.index')->with(['success' => 'Tạo dữ liệu mới thành công']);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function delete ($id)
    {
        $information = PostModel::find($id);
        $information->delete();

        return redirect()->route('admin.post.index')->with(['success'=>"Xóa dữ liệu thành công"]);
    }

    public function edit ($id)
    {
        try{
            $data = PostModel::find($id);
            $titlePage = 'Sửa bào viết';
            $page_menu = 'post';
            $page_sub = null;
            return view('admin.post.edit', compact('titlePage', 'page_menu', 'page_sub', 'data'));
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    public function update ($id, Request $request)
    {
        try{
            $information = PostModel::find($id);
            $information->name = $request->get('name');
            $information->slug = Str::slug($request->get('name'));
            $information->content = $request->get('content');
            $information->type = $request->get('type');
            $information->save();
            return redirect()->route('admin.post.index')->with(['success' => 'Cập nhật dữ liệu thành công']);
        }catch (\Exception $e){
            return back()->with(['error' => $e->getMessage()]);
        }
    }
}
