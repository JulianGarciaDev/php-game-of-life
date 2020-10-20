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
        $newline = '<br/>';
        if (PHP_SAPI === 'cli') $newline = PHP_EOL;

        foreach ($this->universe->getGrid() as $row) {
            foreach ($row as $column) {
                echo $column->printState();
            }
            echo $newline;
        }
        echo $newline;
    }
}
