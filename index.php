<?php

namespace Coffee;

require __DIR__ . '/vendor/autoload.php';

try {
	$map = new Map([
		[0, 1, 0, 1],
		[1, 0, 0, 0],
		[0, 0, 0, 1],
		[0, 0, 0, 1]
	]);

	$table = new Table();

	foreach ($map->describedByArray() as $mapRowIndex => $mapRow) {
		foreach ($mapRow as $mapColumnIndex => $containsCoffee) {
			if ($containsCoffee == true) {
				$tile = new Tile($mapColumnIndex, $mapRowIndex);
				$spot = new Spot($tile);
				$table->addSpot($spot);
			}
		}
	}

	var_dump($map->describedByArray());
}
catch (\Exception $e) {
	echo 'Caught exception: ' . $e->getMessage() . "\n";
}
