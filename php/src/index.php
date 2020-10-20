<?php

use GameOfLife\Domain\Universe;
use GameOfLife\Application\PrintUniverse;
use GameOfLife\Application\UpdateUniverse;

include __DIR__ . "/../vendor/autoload.php";

$config = json_decode(file_get_contents(__DIR__."/config.json"));

$rows = $config->rows;
$columns = $config->columns;
$density = $config->density;
$generations = $config->generations;

if ( ($rows < 1) || ($columns < 1) || ($density < 1) || ($generations < 0) ) {
    echo 'Data error: Modify your config.json'.PHP_EOL;

} else {
    $universe = new Universe($rows, $columns, $density);

    $newline = '<br/>';
    if (PHP_SAPI === 'cli') $newline = PHP_EOL;

    echo $newline;
    echo 'Initial universe:'.$newline;
    $print_universe = new PrintUniverse($universe);
    $print_universe->print();

    for ($i=1; $i <= $generations; $i++) {
        echo 'Generation #'.$i.':'.$newline;
        $update_universe = new UpdateUniverse($universe);
        $universe = $update_universe->update();
        $print_universe = new PrintUniverse($universe);
        $print_universe->print();
    }
}