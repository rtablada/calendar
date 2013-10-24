<?php namespace Rtablada\Calendar;

class CalendarDate extends \Carbon\Carbon
{
	public $active;

	public $display;

	protected $currentDate;

	protected $currentQueryParams = array();

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
		$instance = new static($this);
		$instance->setCurrentDate($this->currentDate);
		$instance->setCurrentQueryParams($this->currentQueryParams);
		return $instance;
	}

	public function setCurrentDate($value)
	{
		$this->currentDate = $value;
	}

	public function setQueryDate($year, $month, $day)
	{
		if ($year) {
			$this->currentQueryParams['year'] = $year;
		}
		if ($month) {
			$this->currentQueryParams['month'] = $month;
		}
		if ($day) {
			$this->currentQueryParams['day'] = $day;
		}
	}

	public function setCurrentQueryParams($value)
	{
		$this->currentQueryParams = $value;
	}

	public function getQueryString()
	{
		$queryParams = $this->currentQueryParams;
		if ($this->year !== $this->currentDate->year) {
			$queryParams['year'] = $this->year;
		}
		if ($this->month !== $this->currentDate->month) {
			$queryParams['month'] = $this->month;
		}
		if ($this->day !== $this->currentDate->day) {
			$queryParams['day'] = $this->day;
		}

		return '?' . http_build_query($queryParams);
		// $query .= ($this->year !== $this->currentDate->year) ? '&year=' . $this->year : null;
		// $query .= ($this->month !== $this->currentDate->month) ? '&month=' . $this->year : null;
		// $query .= ($this->day !== $this->currentDate->day) ? '&day=' . $this->day : null;

		// if ($query === '') {
		// 	return '#';
		// } else {
		// 	return '?' . substr($query, 1);
		// }
	}
}
