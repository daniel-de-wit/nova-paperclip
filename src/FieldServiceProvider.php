<?php

namespace DanielDeWit\NovaPaperclip;

use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class FieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('paperclip-file', __DIR__.'/../dist/js/field.js');
            Nova::style('paperclip-file', __DIR__.'/../dist/css/field.css');

            Nova::script('paperclip-image', __DIR__.'/../dist/js/field.js');
            Nova::style('paperclip-image', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
