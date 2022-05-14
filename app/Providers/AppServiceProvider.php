<?php

namespace App\Providers;



use App\Repositories\Interfaces\SubjectRepositoryInterface;
use App\Repositories\SubjectRepository;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

use App\Repositories\CarDriverRepository;
use App\Repositories\CarGroupRepository;
use App\Repositories\ContractRepository;
use App\Repositories\BrandRepository;
use App\Repositories\ModelRepository;
use App\Repositories\MotorPoolRepository;
use App\Repositories\PaymentRepository;
use App\Repositories\CarOwnerRepository;
use App\Repositories\TimeSheetRepository;
use App\Repositories\RentEventRepository;
use App\Repositories\EventRentalRepository;
use App\Repositories\EventTransferRepository;
use App\Repositories\EventFineRepository;
use App\Repositories\EventCrashRepository;
use App\Repositories\PhotoRepository;
use App\Repositories\ToPaymentRepository;
use App\Repositories\AdditionalRepository;

use App\Repositories\Interfaces\BrandRepositoryInterface;
use App\Repositories\Interfaces\ModelRepositoryInterface;
use App\Repositories\Interfaces\MotorPoolRepositoryInterface;
use App\Repositories\Interfaces\CarDriverRepositoryInterface;
use App\Repositories\Interfaces\ContractRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\CarGroupRepositoryInterface;
use App\Repositories\Interfaces\CarOwnerRepositoryInterface;
use App\Repositories\Interfaces\TimeSheetRepositoryInterface;
use App\Repositories\Interfaces\RentEventRepositoryInterface;
use App\Repositories\Interfaces\EventRentalRepositoryInterface;
use App\Repositories\Interfaces\EventTransferRepositoryInterface;
use App\Repositories\Interfaces\EventFineRepositoryInterface;
use App\Repositories\Interfaces\EventCrashRepositoryInterface;
use App\Repositories\Interfaces\PhotoRepositoryInterface;
use App\Repositories\Interfaces\ToPaymentRepositoryInterface;
use App\Repositories\Interfaces\AdditionalRepositoryInterface;


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
        $this->app->bind(ContractRepositoryInterface::class,ContractRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class,PaymentRepository::class);
        $this->app->bind(CarGroupRepositoryInterface::class,CarGroupRepository::class);
        $this->app->bind(CarOwnerRepositoryInterface::class,CarOwnerRepository::class);
        $this->app->bind(TimeSheetRepositoryInterface::class,TimeSheetRepository::class);
        $this->app->bind(RentEventRepositoryInterface::class,RentEventRepository::class);
        $this->app->bind(EventRentalRepositoryInterface::class,EventRentalRepository::class);
        $this->app->bind(EventTransferRepositoryInterface::class,EventTransferRepository::class);
        $this->app->bind(EventFineRepositoryInterface::class,EventFineRepository::class);
        $this->app->bind(EventCrashRepositoryInterface::class,EventCrashRepository::class);
        $this->app->bind(PhotoRepositoryInterface::class,PhotoRepository::class);
        $this->app->bind(ToPaymentRepositoryInterface::class,ToPaymentRepository::class);
        $this->app->bind(AdditionalRepositoryInterface::class,AdditionalRepository::class);

        $this->app->bind(CarDriverRepositoryInterface::class,CarDriverRepository::class);
        $this->app->bind(SubjectRepositoryInterface::class,SubjectRepository::class);


    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('ru');
    }
}
