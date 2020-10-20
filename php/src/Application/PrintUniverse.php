<?php

declare(strict_types=1);

namespace GameOfLife\Application;

use GameOfLife\Domain\Universe;

class PrintUniverse
{
    private Universe $universe;

    public function __construct(Universe $universe)
    {
        $this->universe = $universe;
    }

    public function print()
    {
        foreach ($this->universe->getGrid() as $row) {
            foreach ($row as $column) {
                echo $column->printState();
            }
            echo PHP_EOL;
        }
        echo PHP_EOL;
    }
}
