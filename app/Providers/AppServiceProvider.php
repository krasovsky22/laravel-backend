<?php

namespace App\Providers;

use Illuminate\Contracts\Container\BindingResolutionException;
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
        //
    }

    /**
     * @throws BindingResolutionException
     * Bootstrap any application services.
     */
    public function boot()
    {
        $this->bootBlizzardSocialite();
    }

    /**
     * @throws BindingResolutionException
     */
    private function bootBlizzardSocialite()
    {
        $socialite = $this->app->make('Laravel\Socialite\Contracts\Factory');
        $socialite->extend(
            'blizzard',
            static function ($app) use ($socialite) {
                $config = $app['config']['services.blizzard'];
                return $socialite->buildProvider(BlizzardProvider::class, $config);
            }
        );
    }
}
