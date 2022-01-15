<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Contracts\FoodMenuContract;
use App\Repositories\FoodmenuRepository;
use App\Contracts\FoodContract;
use App\Repositories\FoodRepository;



class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        FoodMenuContract::class => FoodmenuRepository::class,
        FoodContract::class => FoodRepository::class,
    ];
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        //dd(get_declared_classes());
        foreach ($this->repositories as $interface => $implementation)
        {
            $this->app->bind($interface, $implementation);
        }

        
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
