<?php

namespace App\Providers;

use App\Models\Category;
use App\Support\Cart;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour();

        View::composer('layouts.store', function ($view) {
            $view->with('navCategories', Category::orderBy('sort_order')->get());
            $view->with('cartCount', Cart::count());
            $view->with('cartTotal', Cart::subtotal());
            $view->with('wishlistCount', count(session('wishlist', [])));
        });
    }
}
