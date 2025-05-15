<?php

namespace App\Providers;

use App\Repositories\AdminRoleRepository;
use App\Repositories\AppointmentRepository;
use App\Repositories\ClinicRepository;
use App\Repositories\DoctorRepository;
use App\Repositories\Interfaces\AdminRoleRepositoryInterface;
use App\Repositories\Interfaces\AppointmentRepositoryInterface;
use App\Repositories\Interfaces\ClinicRepositoryInterface;
use App\Repositories\Interfaces\DoctorRepositoryInterface;
use App\Repositories\Interfaces\userInterface\UserAppointmentRepositoryInterface;
use App\Repositories\userRepository\UserAppointmentRepository;
use App\Services\Admin\Interfaces\RoleServiceInterface;
use App\Services\Admin\RoleService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(ClinicRepositoryInterface::class, ClinicRepository::class);
        $this->app->bind(AppointmentRepositoryInterface::class, AppointmentRepository::class);
        $this->app->bind(UserAppointmentRepositoryInterface::class, UserAppointmentRepository::class);
        $this->app->bind(DoctorRepositoryInterface::class, DoctorRepository::class);
        $this->app->bind(AdminRoleRepositoryInterface::class, AdminRoleRepository::class);

        $this->app->bind(RoleServiceInterface::class, RoleService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
