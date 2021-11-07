<?php

namespace App\Providers;

use App\Repositories\MotorPoolRepositoryRepository;
use Illuminate\Support\ServiceProvider;

use App\Repositories\BrandRepository;
use App\Repositories\ModelRepository;
use App\Repositories\MotorPoolRepository;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;

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
