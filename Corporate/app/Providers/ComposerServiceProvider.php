<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot() {
        View::composer('*', 'App\Http\ViewComposers\ViewDataComposer');
        View::composer('*profile*', 'App\Http\ViewComposers\ViewDataComposer@ViewForProfile'); // data served to the profile views
        View::composer(['*announcements*', '*awards*'], 'App\Http\ViewComposers\ViewDataComposer@ViewForAnnouncements'); //data served to the profile views
        View::composer(['*employees*'], 'App\Http\ViewComposers\ViewDataComposer@ViewForEmployees'); //data served to the employee views
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register() {
        //
    }

}
