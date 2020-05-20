<?php

$maxExecution = (10**10);
$numberOfTries = 1000000; // 1 million executions

function sortNumber(): array {
	$numbers[0] = rand(1,100);
	$numbers[1] = rand(1,100);
	$numbers[2] = rand(1,100);
	$numbers[3] = rand(1,100);
	$numbers[4] = rand(1,100);
	$numbers[5] = rand(1,100);
	$numbers[6] = rand(1,100);
	$numbers[7] = rand(1,100);
	$numbers[8] = rand(1,100);
	$numbers[9] = rand(1,100);
	$numbers[10] = rand(1,100);
	$numbers[11] = rand(1,100);
    sort($numbers);
    return $numbers;
}

$startTime = microtime(true);
for($i=0;$i<=$numberOfTries;$i++) {
	$x = sortNumber();
}
$endTime = microtime(true);
$seconds = round($endTime - $startTime);

$totalTimeInSeconds = floor($seconds * ($maxExecution / $numberOfTries));
echo date('G:i:s', $totalTimeInSeconds);