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

		$yearQuery = $this->request->input('year');
		$monthQuery = $this->request->input('month');
		$dayQuery = $this->request->input('day');

		$year = $yearQuery ?: $year;
		$month = $monthQuery ?: $month;
		$day = $dayQuery ?: $day;

		$date = $this->calendarDate->now()->year($year)->month($month)->day($day);
		$date->setQueryDate($yearQuery, $monthQuery, $dayQuery);

		return $date;
	}

	public function yearLinks($selectedDate = null, $startYear=null, $endYear=null, array $options = array())
	{
		$selected = $this->getDateFromInput($selectedDate)->active();
		$selected->setCurrentDate($selected);
		$current = $this->calendarDate->now();
		$previous =
			(!isset($options['previous']) || $options['previous'])
			? $selected->newInstance()->subYear()
			: null;
		$next = (!isset($options['next']) || $options['next'])
			? $selected->newInstance()->addYear()
			: null;
		$startYear = $startYear ?: $previous->year;
		$endYear = $endYear ?: $next->year;
		$years = array();

		for ($i = $startYear; $i <= $endYear; $i ++) {
			$calendarDate = $selected->newInstance();
			$year = $calendarDate->year($i);

			$years[] = $this->setDisplayForDate($year, $selected, $current, $options);;
		}

		return $this->view->make('calendar::year', compact('years', 'next', 'previous'));
	}

	public function monthLinks($selectedDate = null, array $options = array())
	{
		$selected = $this->getDateFromInput($selectedDate)->active();
		$selected->setCurrentDate($selected);
		$current = $this->calendarDate->now();
		$previous =
			(!isset($options['previous']) || $options['previous'])
			? $selected->newInstance()->subMonth(1)
			: null;
		$next = (!isset($options['next']) || $options['next'])
			? $selected->newInstance()->addMonth(1)
			: null;
		$months = array();

		for ($i = 1; $i <= 12; $i++) {
			$calendarDate = $selected->newInstance();
			$month = $calendarDate->month($i);

			$months[] = $this->setDisplayForDate($month, $selected, $current, $options);
		}

		return $this->view->make('calendar::month', compact('months', 'next', 'previous'));
	}

	public function dayLinks($selectedDate = null, array $options = array())
	{
		$selected = $this->getDateFromInput($selectedDate)->active();
		$selected->setCurrentDate($selected);
		$current = $this->calendarDate->now();

		$previous =
			(!isset($options['previous']) || $options['previous'])
			? $selected->newInstance()->subDay()
			: null;
		$next = (!isset($options['next']) || $options['next'])
			? $selected->newInstance()->addDay()
			: null;

		$months = array();

		for ($i = 1; $i <= $current->format('t') ; $i++) {
			$calendarDate = $selected->newInstance();
			$day = $calendarDate->day($i);

			$days[] = $this->setDisplayForDate($day, $selected, $current, $options);
		}

		return $this->view->make('calendar::day', compact('days', 'next', 'previous'));
	}

	protected function setDisplayForDate($date, $selected, $current, $options)
	{
		if ($date->eq($selected)) {
			$date->display('active');
		} elseif (isset($options['before_selected']) && $date->lt($selected)) {
			$date->display($options['before_selected']);
		} elseif (isset($options['after_selected']) && $date->gt($selected)) {
			$date->display($options['before_selected']);
		} elseif (isset($options['before_current']) && $date->lt($current)) {
			$date->display($options['before_current']);
		} elseif (isset($options['after_current']) && $date->gt($current)) {
			$date->display($options['after_current']);
		}

		return $date;
	}
}
