<?php
	$field = 'year';
	$dates = $years;
	echo View::make('calendar::bootstrap2._datePagination', compact('next', 'previous', 'field', 'dates'));
