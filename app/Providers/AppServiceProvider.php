<?php

namespace App\Providers;

use App\Model\BusinessSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

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
            try {
                View::share('web_config', [
                    'adsterra_adds' => BusinessSetting::where('type', 'adsterra_adds')->first(),
                    'adsterra_social_adds' => BusinessSetting::where('type', 'adsterra_social_adds')->first(),
                    'adsterra_alert_adds' => BusinessSetting::where('type', 'adsterra_alert_adds')->first(),
                    'whatsappJoinModal' => BusinessSetting::where('type', 'whatsappJoinModal')->first(),

                ]);
                // View::share("socialmedia", SocialMedia::where('active_status', 1)->get());
                // View::share("categories", Category::where('home_status',1)->get());
                // View::share("instagram",SocialMedia::where('name','instagram')->first());
                // View::share("linkedin",SocialMedia::where('name','linkedin')->first());
                // View::share("tiktok",SocialMedia::where('name','tiktok')->first());
                // View::share("twitter",SocialMedia::where('name','twitter')->first());
            } catch (\Exception $ex) {
            }

            Schema::defaultStringLength(191);

            if (request()->segment(1) === 'job-city') {
            $city = request()->segment(2);

            if ($city && $city !== strtolower($city)) {
                return redirect('/job-city/' . strtolower($city), 301)->send();
            }
         }
    }
}
