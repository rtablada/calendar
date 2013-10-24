<?php namespace Rtablada\Calendar;

use Illuminate\Http\Request;
use Illuminate\View\Environment as View;

class CalendarBuilder
{
	protected $request;

	protected $view;

	protected $calendarDate;

	public function __construct(CalendarDate $calendarDate)
	{
		$this->calendarDate = $calendarDate;
	}

	public function setRequest(Request $request)
	{
		$this->request = $request;
	}

	public function setView(View $view)
	{
		$this->view = $view;
	}

	public function getDateFromInput($dateOptions = null)
	{
		// No date means get the input and default to today
		if ($dateOptions == null) {
			$year = date('Y');
			$month = date('m');
			$day = date('d');
		} elseif (is_a($dateOptions, 'Carbon\\Carbon')) {
			$year = $dateOptions->year;
			$month = $dateOptions->month;
			$day = $dateOptions->day;
		} elseif (is_array($dateOptions)) {
			$year = isset($dateOptions['year']) ?: date('y');
			$month = isset($dateOptions['month']) ?: date('m');
			$day = isset($dateOptions['day']) ?: date('d');
		} else {
			$dateOptions = func_get_args();

			$year = isset($dateOptions[2]) ?: date('y');
			$month = isset($dateOptions[1]) ?: date('m');
			$day = isset($dateOptions[0]) ?: date('d');
		}

		$year = $this->request->input('year', $year);
		$month = $this->request->input('month', $month);
		$day = $this->request->input('day', $day);

		return $this->calendarDate->now()->year($year)->month($month)->day($day);
	}

	public function monthLinks($currentDate = null, array $options = array())
	{
		$calendarDate = $this->calendarDate->now();
		$active = $this->getDateFromInput($currentDate)->active();
		$previous	= (!isset($options['previous'])	|| $options['previous']) ? $calendarDate->subMonth(1)	: null;
		$next 		= (!isset($options['next'])		|| $options['next']) ? $calendarDate->subMonth(1)		: null;
		$months = array();

		for ($i = 1; $i <= 12; $i++) {
			if ($i != $active->month) {
				$month = $calendarDate->month($i);
				$months[] = $month;
			} else {
				$months[] = $active;
			}
		}

		return $this->view->make('calendar::month', compact('months', 'next', 'previous'));
	}
}
