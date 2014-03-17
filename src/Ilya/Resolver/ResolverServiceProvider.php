<?php namespace Ilya\Resolver;

use Illuminate\Support\ServiceProvider;

class ResolverServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->registerArtisanCommands();
    }

    /**
     * Register Artisan commands
     *
     * @return void
     */
    protected function registerArtisanCommands()
    {
        $this->app['resolver.resolve'] = $this->app->share(function($app)
        {
            $resolver = $app->make('\Ilya\Resolver\Resolver');

            return new Commands\ResolveCommand($resolver);
        });

        $this->commands('resolver.resolve');
    }

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
