<?php

wc_get_logger()->info( 'My log message' );

$elapsed_time_since_breakfast = strtotime( 'now - 2 hours' );

wc_get_logger()->info(
	'It is time for lunch.',
	array(
		'source'        => 'your-stomach',
		'backtrace'     => true,
		'previous_meal' => $elapsed_time_since_breakfast,
		'lunch_options' => array( 'fridge leftovers', 'bahn mi', 'tacos', 'pupusas' ),
	)
);
