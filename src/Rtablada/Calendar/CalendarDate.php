<?php namespace Rtablada\Calendar;

class CalendarDate extends \Carbon\Carbon
{
	public $active;

	public $display;

	public function active($value = true)
	{
		$this->active = $value;

		return $this;
	}

	public function display($value = 'show')
	{
		$this->display = $value;

		return $this;
	}

	public function newInstance()
	{
		return new static($this);
	}
}
