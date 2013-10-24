<?php

use Rtablada\Calendar\CalendarBuilder;
use Carbon\Carbon;
use Mockery as m;

class CalendarBuilderTest extends PHPUnit_Framework_TestCase
{
	public function setup()
	{
		$this->builder = new CalendarBuilder(new Carbon);
		$this->request = m::mock('Illuminate\\Http\\Request');
		$this->builder->setRequest($this->request);

		$this->date = Carbon::now()->year(2012)->month(01)->day(04);
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
}
