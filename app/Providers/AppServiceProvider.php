<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $tenant = \Spatie\Multitenancy\Models\Tenant::checkCurrent();
        if ($tenant != "") {
            $dataSetting = Setting::first();
            Config::set([
                // 'idsemester_aktif' => $dataSetting->idsemester,
                'curr_tenant' => app('currentTenant')->name
            ]);
        }
        Schema::defaultStringLength(191);

    }
}
