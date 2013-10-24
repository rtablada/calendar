<?php
	$field = 'day';
	$dates = $days;
	echo View::make('calendar::bootstrap2._datePagination', compact('next', 'previous', 'field', 'dates'));
