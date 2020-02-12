<?php

class Interval {

	function get ($intervals) {
		$changeIntervals = 0;
		usort($intervals, function ($a, $b) {
			return $a[0] - $b[0];
		});

	  for ($i = 0; $i < count($intervals); $i++) {
	  	$start = $intervals[$i][0];
	  	$end = $intervals[$i][1];

	  	for ($j = 1; $j < count($intervals); $j++){
				if ($start <= $intervals[$j][1] && $end >= $intervals[$j][0]){

					$interval = array_merge([$start, $end], $intervals[$j]);
					usort($interval, function ($a, $b) {
						return $a - $b;
					});

				  $start = $interval[0];
	        $end = $interval[count($interval) - 1];
					array_splice($intervals, $j, 1);
	        $j--;
				}
	      if ($j === count($intervals) - 1){
	      	$changeIntervals += ($end - $start);
	      }
	    }
	  }
	  return $changeIntervals;

	}
}

$interval = new Interval;

print_r($interval->get([[1,4],  [7, 10],  [3, 5]]));
