<?php namespace Rtablada\Calendar;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarBuilder
{
	protected $request;

	protected $carbon;

	public function __construct(Carbon $carbon)
	{
		$this->carbon = $carbon;
	}

	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

	public function getDateFromInput($dateOptions = null)
	{
		// No date means get the input and default to today
		if ($dateOptions == null) {
			$year = $this->request->input('year', date('Y'));
			$month = $this->request->input('month', date('m'));
			$day = $this->request->input('day', date('d'));

			return $this->carbon->now()->year($year)->month($month)->day($day);
		}
	}
}
