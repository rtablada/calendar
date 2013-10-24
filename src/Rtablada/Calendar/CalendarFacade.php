<?php namespace Rtablada\Calendar;

use Illuminate\Support\Facades\Facade;

class CalendarFacade extends Facade {

	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor() { return 'calendar'; }

}
