<?php namespace Ilya\Resolver;

use Illuminate\Support\ServiceProvider;

class ResolverServiceProvider extends ServiceProvider {

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
     * Register the Artisan commands
     *
     * @return void
     */
    protected function registerArtisanCommands()
    {
        $this->app->singleton('resolver.resolve', function($app)
        {
            $resolver = $app->make('Ilya\Resolver\Resolver');

            return new Commands\ResolveCommand($resolver);
        });

        $this->commands('resolver.resolve');
    }

}

