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
        $category = CategoryModel::where('type', 1)
            ->with([
                'children.grandchildren'
            ])
            ->get();
        $setting = SettingModel::first();
        $post1 = PostModel::where('type',1)->get();
        $post2 = PostModel::where('type',2)->get();

        view()->share('category', $category);
        view()->share('setting', $setting);
        view()->share('post1', $post1);
        view()->share('post2', $post2);

    }
}
