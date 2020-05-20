<?php

$maxExecution = (10**10);
$numberOfTries = 1000; 

function generateNumbers(): array {
	for($i=0;$i<=10000;$i++) {
		$numbers[$i] = (rand(100,10000) ** rand(100,10000));
	}
    return $numbers;
}

function sortNumber($numbers): array {
    sort($numbers);
    return $numbers;
}

$startTime = microtime(true);
$numbers = generateNumbers();
for($i=0;$i<=$numberOfTries;$i++) {
	$x = sortNumber($numbers);
}
$endTime = microtime(true);
$seconds = floor($endTime - $startTime);

$totalTimeInSeconds = floor($seconds * ($maxExecution / $numberOfTries));
echo date('G:i:s', $totalTimeInSeconds);