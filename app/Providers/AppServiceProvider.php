<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // 'key' => 'value'
        $settings = Setting::all('key', 'value')
            ->keyBy('key')
            ->transform(function ($setting) {
                return $setting->value;
            })
            ->toArray();
        config([
            'settings' => $settings
        ]);

        config(['app.name' => config('settings.app_name')]);
    }
}
