<?php namespace Rtablada\Calendar;

use Illuminate\Support\ServiceProvider;

class CalendarServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	public function boot()
	{
		$this->package('rtablada/calendar');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$me = $this;

		$this->app['calendar'] = $this->app->share(function($app) use ($me)
		{
			$builder = new CalendarBuilder(new CalendarDate);

			$builder->setRequest($app['request']);
			$builder->setView($app['view']);

			return $builder;
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('calendar');
	}

}
