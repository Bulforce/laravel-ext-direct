<?php namespace Bulforce\ExtDirect;

use Illuminate\Support\ServiceProvider;

class ExtDirectServiceProvider extends ServiceProvider {

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
		$this->package('bulforce/ext-direct');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->app['ext-direct'] = $this->app->share(function($app)
        {
            return new ExtDirect;
        });

        $this->app->booting(function()
        {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('ExtDirect', 'Bulforce\ExtDirect\Facades\ExtDirect');
        });

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('ext-direct');
	}

}
