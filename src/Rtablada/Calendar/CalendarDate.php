<?php namespace Rtablada\Calendar;

class CalendarDate extends \Carbon\Carbon
{
	public $active;

	public function active($value = true)
	{
		$this->active = $value;

		return $this;
	}
}
