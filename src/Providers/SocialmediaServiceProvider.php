<?php

namespace marvinosswald\Socialmedia\Providers;

use \Illuminate\Support\ServiceProvider;
/**
 * Class SocialmediaServiceProvider
 * @package Marvinosswald\Socialmedia\Providers
 */
class SocialmediaServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;
    /**
     * Bootstrap the application.
     *
     * @return void
     */
    public function boot()
    {

    }
    /**
     * Register the package.
     */
    public function register()
    {
        $this->app->bind('socialmedia','marvinosswald\Socialmedia\Socialmedia');
    }
    /**
     * The services that package provides.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}