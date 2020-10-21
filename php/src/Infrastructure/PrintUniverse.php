<?php

declare(strict_types=1);

namespace GameOfLife\Infrastructure;

use GameOfLife\Domain\Universe;
use GameOfLife\Infrastructure\PrintCell;

class PrintUniverse
{
    private Universe $universe;
    private int $generation;
    private string $newline;

    public function __construct(Universe $universe, int $generation)
    {
        $this->universe = $universe;
        $this->generation = $generation;
        $this->newline = '<br/>';
        if (PHP_SAPI === 'cli')
            $this->newline = PHP_EOL;
    }

    public function print()
    {
        echo $this->newline;
        echo 'Generation #'.$this->generation.':';
        echo $this->newline;

        foreach ($this->universe->getGrid() as $row) {
            foreach ($row as $column) {
                $printCell = new PrintCell($column);
                echo $printCell->print();
            }
            echo $this->newline;
        }
        echo $this->newline;
    }
}
