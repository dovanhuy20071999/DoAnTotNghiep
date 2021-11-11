<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\User\UserRepositoryInterface::class,
            \App\Repositories\User\UserRepositoryEloquent::class,
        );
        $this->app->singleton(
            \App\Repositories\Essay\EssayRepositoryInterface::class,
            \App\Repositories\Essay\EssayRepositoryEloquent::class,
        );
        $this->app->singleton(
            \App\Repositories\Deadline\DeadlineRepositoryInterface::class,
            \App\Repositories\Deadline\DeadlineRepositoryEloquent::class,
        );
        $this->app->singleton(
            \App\Repositories\Order\OrderRepositoryInterface::class,
            \App\Repositories\Order\OrderRepositoryEloquent::class,
        );
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
