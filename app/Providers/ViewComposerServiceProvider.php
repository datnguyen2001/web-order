<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Compose the countCartItem for all views
        View::composer('*', function ($view) {
            $countCartItem = Auth::check() ? Cart::where('user_id', Auth::user()->id)->count() : 0;
            $view->with('countCartItem', $countCartItem);
        });
    }
}
