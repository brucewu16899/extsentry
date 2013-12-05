<?php namespace Srit83\Extsentry;

use Cartalyst\Sentry\Hashing\NativeHasher;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ExtsentryServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('srit83/extsentry', 'srit83/extsentry');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register('LaravelBook\Ardent\Providers\ArdentServiceProvider');
        $this->app->register('Cartalyst\Sentry\SentryServiceProvider');
        $this->_registerUserProvider();
        $this->app['extsentry'] = $this->app->share(function ($oApp) {
            $oApp->register('Cartalyst\Sentry\SentryServiceProvider');
            return new Extsentry($oApp['extsentry.user']);
        });
        $this->app->booting(function () {
            $oLoader = AliasLoader::getInstance();
            $oLoader->alias('Extsentry', 'Srit83\Extsentry\Facades\Extsentry');
        });

    }

    protected function _registerUserProvider()
    {
        $this->app['extsentry.user'] = $this->app->share(function($oApp)
        {
            $sModel = $oApp['config']['srit83/extsentry::users.model'];
            return new Providers\User($oApp['sentry.hasher'], $sModel);
        });
    }

}