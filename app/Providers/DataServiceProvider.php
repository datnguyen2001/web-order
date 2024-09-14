<?php

namespace App\Providers;

use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\SettingModel;
use Illuminate\Support\ServiceProvider;

class DataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {

    }



    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $category = CategoryModel::where('type',1)->get();
        foreach ($category as $item){
            $item->category_sub_2 = CategoryModel::where('parent_id',$item->id)->get();
            foreach ($item->category_sub_2 as $cate){
                $cate->category_sub_3 = CategoryModel::where('child_id',$cate->id)->get();
            }
        }
        $setting = SettingModel::first();
        $post1 = PostModel::where('type',1)->get();
        $post2 = PostModel::where('type',2)->get();

        view()->share('category', $category);
        view()->share('setting', $setting);
        view()->share('post1', $post1);
        view()->share('post2', $post2);

    }
}
