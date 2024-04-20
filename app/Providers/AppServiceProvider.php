<?php

namespace App\Providers;

use App\Interfaces\Email\EmailServiceInterface;
use App\Interfaces\User\UserRepositoryInterface;
use App\Interfaces\AuthReponsitoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Auth\AuthRepository;
use App\Services\Email\EmailService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AuthReponsitoryInterface::class, AuthRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(EmailServiceInterface::class, EmailService::class);
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
