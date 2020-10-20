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

$universe = new Universe($rows, $columns, $density);

echo PHP_EOL;
echo 'Initial universe:'.PHP_EOL;
$print_universe = new PrintUniverse($universe);
$print_universe->print();

for ($i=1; $i <= $generations; $i++) {
    echo 'Generation #'.$i.':'.PHP_EOL;
    $update_universe = new UpdateUniverse($universe);
    $universe = $update_universe->update();
    $print_universe = new PrintUniverse($universe);
    $print_universe->print();
}