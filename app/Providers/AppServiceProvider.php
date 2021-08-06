<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Bookings\BookingInterface;
use App\Bookings\IndividualSession;
use App\Bookings\GroupSession;
use App\Bookings\WebinarSession;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(BookingInterface::class, function(){

            if(session()->has('selected_session')){
                if(session('selected_session.id') == 3){
                    return new GroupSession;
                }elseif(session('selected_session.id') == 2){
                    return new WebinarSession;
                }
            }
            return new IndividualSession;
        });
    }
}
