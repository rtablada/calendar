<?php
	$field = 'month';
	$dates = $months;
	echo View::make('calendar::bootstrap2._datePagination', compact('next', 'previous', 'field', 'dates'));
