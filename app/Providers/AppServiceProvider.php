<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;

use App\Repositories\CarDriverRepository;
use App\Repositories\CarGroupRepository;
use App\Repositories\ContractRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ModelRepository;
use App\Repositories\MotorPoolRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\CarOwnerRepository;


use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Repositories\Interfaces\CarOwnerRepositoryInterface;


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
        $this->app->bind(PaymentRepositoryInterface::class,PaymentRepository::class);
        $this->app->bind(CarGroupRepositoryInterface::class,CarGroupRepository::class);
        $this->app->bind(CarOwnerRepositoryInterface::class,CarOwnerRepository::class);

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
