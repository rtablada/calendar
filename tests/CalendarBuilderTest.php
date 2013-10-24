<?php

use Rtablada\Calendar\CalendarBuilder;
use Carbon\Carbon;
use Mockery as m;

class CalendarBuilderTest extends PHPUnit_Framework_TestCase
{
	protected $dateArray = array(
		'year' => 2012,
		'month' => 01,
		'day' => 04,
	);

	public function setup()
	{
		$this->builder = new CalendarBuilder(new Carbon);
		$this->request = m::mock('Illuminate\\Http\\Request');
		$this->view = m::mock('Illuminate\\View\\Environment');
		$this->builder->setRequest($this->request);
		$this->builder->setView($this->view);

		$this->date = Carbon::now()
			->year($this->dateArray['year'])
			->month($this->dateArray['month'])
			->day($this->dateArray['day']);
	}

	public function test_getDateFromInput_with_null_input()
	{
		$this->request->shouldReceive('input')
			->with('year', date('Y'))
			->once()
			->andReturn(date('Y'));
		$this->request->shouldReceive('input')
			->with('month', date('m'))
			->once()
			->andReturn(date('m'));
		$this->request->shouldReceive('input')
			->with('day', date('d'))
			->once()
			->andReturn(date('d'));

		$response = $this->builder->getDateFromInput();

		$this->assertEquals(Carbon::now(), $response);
	}

	public function test_getDateFromInput_with_day_input()
	{
		$this->request->shouldReceive('input')
			->with('year', date('Y'))
			->once()
			->andReturn(date('Y'));
		$this->request->shouldReceive('input')
			->with('month', date('m'))
			->once()
			->andReturn(date('m'));
		$this->request->shouldReceive('input')
			->with('day', date('d'))
			->once()
			->andReturn($this->date->day);

		$response = $this->builder->getDateFromInput();

		$this->assertEquals(Carbon::now()->day($this->date->day), $response);
	}

	public function test_getDateFromInput_with_all_input()
	{
		$this->request->shouldReceive('input')
			->with('year', date('Y'))
			->once()
			->andReturn($this->date->year);
		$this->request->shouldReceive('input')
			->with('month', date('m'))
			->once()
			->andReturn($this->date->month);
		$this->request->shouldReceive('input')
			->with('day', date('d'))
			->once()
			->andReturn($this->date->day);

		$response = $this->builder->getDateFromInput();

		$this->assertEquals($this->date, $response);
	}

	public function test_getDateFromInput_with_carbon_instance_and_no_input()
	{
		$this->request->shouldReceive('input')
			->with('year', $this->date->year)
			->once()
			->andReturn($this->date->year);
		$this->request->shouldReceive('input')
			->with('month', $this->date->month)
			->once()
			->andReturn($this->date->month);
		$this->request->shouldReceive('input')
			->with('day', $this->date->day)
			->once()
			->andReturn($this->date->day);

		$response = $this->builder->getDateFromInput($this->date);

		$this->assertEquals($this->date, $response);
	}

	public function test_getDateFromInput_with_carbon_instance_and_input()
	{
		$this->request->shouldReceive('input')
			->with('year', $this->date->year)
			->once()
			->andReturn(date('Y'));
		$this->request->shouldReceive('input')
			->with('month', $this->date->month)
			->once()
			->andReturn($this->date->month);
		$this->request->shouldReceive('input')
			->with('day', $this->date->day)
			->once()
			->andReturn($this->date->day);

		$response = $this->builder->getDateFromInput($this->date);

		$this->assertEquals($this->date->year(date('Y')), $response);
	}

	public function test_getDateFromInput_with_array_and_input()
	{
		$this->request->shouldReceive('input')
			->with('year', $this->date->year)
			->once()
			->andReturn(date('Y'));
		$this->request->shouldReceive('input')
			->with('month', $this->date->month)
			->once()
			->andReturn($this->date->month);
		$this->request->shouldReceive('input')
			->with('day', $this->date->day)
			->once()
			->andReturn($this->date->day);

		$response = $this->builder->getDateFromInput($this->dateArray);

		$this->assertEquals($this->date->year(date('Y')), $response);
	}

	public function test_getDateFromInput_with_args()
	{
		$this->request->shouldReceive('input')
			->with('year', $this->date->year)
			->once()
			->andReturn(date('Y'));
		$this->request->shouldReceive('input')
			->with('month', $this->date->month)
			->once()
			->andReturn($this->date->month);
		$this->request->shouldReceive('input')
			->with('day', $this->date->day)
			->once()
			->andReturn($this->date->day);

		$response = $this->builder->getDateFromInput($this->dateArray['day'], $this->dateArray['month'], $this->dateArray['year']);

		$this->assertEquals($this->date->year(date('Y')), $response);
	}

	public function test_monthLinks()
	{
		$carbon = Carbon::now();
		$active = Carbon::now();
		$shown = array();

		for ($i = 1; $i <= 12; $i++) {
			if ($i != $active->month) {
				$shown[] = $carbon->month($i);
			}
		}

		$this->view->shouldReceive('make')
			->with('calendar::month', compact('shown', 'active'));
		$this->builder->monthLinks();
	}
}
