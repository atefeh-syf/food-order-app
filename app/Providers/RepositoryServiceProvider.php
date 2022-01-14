<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;

use App\Contracts\BaseContract;
use App\Repositories\BaseRepository;
use App\Contracts\FoodMenuContract;
use App\Repositories\FoodmenuRepository;



class RepositoryServiceProvider extends ServiceProvider
{
    protected $repositories = [
        BaseContract::class => BaseRepository::class,
        FoodMenuContract::class => FoodmenuRepository::class,
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
