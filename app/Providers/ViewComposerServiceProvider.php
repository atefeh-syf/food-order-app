<?php

namespace App\Providers;

use Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\FoodMenu;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //

        /* View::composer('general.partials.nav', function ($view) {
            $view->with('foodMenus', FoodMenu::orderByRaw('-name ASC')->get());
        }); */
        
        View::composer('general.partials.header', function ($view) {
            $view->with('cartCount', Cart::getContent()->count());
        });
    }
}
