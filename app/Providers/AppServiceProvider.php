<?php

namespace App\Providers;

use App\Repositories\CarDriverRepository;
use App\Repositories\ContractRepository;
use App\Repositories\MotorPoolRepositoryRepository;
use Illuminate\Support\ServiceProvider;

use App\Repositories\BrandRepository;
use App\Repositories\ModelRepository;
use App\Repositories\MotorPoolRepository;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use App\Repositories\Interfaces\ContractRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BrandRepositoryInterface::class,BrandRepository::class);
        $this->app->bind(ModelRepositoryInterface::class,ModelRepository::class);
        $this->app->bind(MotorPoolRepositoryInterface::class,MotorPoolRepository::class);
        $this->app->bind(CarDriverRepositoryInterface::class,CarDriverRepository::class);
        $this->app->bind(ContractRepositoryInterface::class,ContractRepository::class);



    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
