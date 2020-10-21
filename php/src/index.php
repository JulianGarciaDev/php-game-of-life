<?php

use GameOfLife\Application\CreateUniverse;
use GameOfLife\Application\UpdateUniverse;
use GameOfLife\Infrastructure\PrintUniverse;

include __DIR__ . "/../vendor/autoload.php";

$config = json_decode(file_get_contents(__DIR__."/config.json"));

$rows = $config->rows;
$columns = $config->columns;
$density = $config->density;
$generations = $config->generations;

if ( ($rows < 1) || ($columns < 1) || ($density < 1) || ($generations < 0) ) {
    echo 'Data error: Modify your config.json'.PHP_EOL;

} else {
    $createUniverse = new CreateUniverse($rows, $columns, $density);
    $universe = $createUniverse->create();

    $printUniverse = new PrintUniverse($universe, 0);
    $printUniverse->print();

    for ($i=1; $i <= $generations; $i++) {
        $updateUniverse = new UpdateUniverse($universe);
        $universe = $updateUniverse->update();

        $printUniverse = new PrintUniverse($universe, $i);
        $printUniverse->print();
    }
}