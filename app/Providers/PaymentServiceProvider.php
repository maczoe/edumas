<?php

namespace App\Providers;
use App\Services\PaymentService;
use Illuminate\Support\ServiceProvider;

class PaymentServiceProvider extends ServiceProvider
{
    
    protected $defer = true;
    
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Helpers\Contracts\PaymentServiceContract', function() {
            return new PaymentService();
        });
    }
    
    public function provides()
    {
        return ['App\Helpers\Contracts\PaymentServiceContract'];
    }
}
