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
}
