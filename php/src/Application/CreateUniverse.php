<?php

declare(strict_types=1);

namespace GameOfLife\Application;

use GameOfLife\Domain\Universe;

class CreateUniverse
{
    private Universe $universe;

    public function __construct(int $rows, int $columns, int $density)
    {
        $this->universe = new Universe($rows, $columns, $density);
    }

    public function create(): Universe
    {
        $this->randomAlive();
        return $this->universe;
    }

    private function randomAlive(): void
    {
        $rows = $this->universe->getRows();
        $columns = $this->universe->getColumns();
        $density = $this->universe->getDensity();
        $grid = $this->universe->getGrid();

        for ($i=0; $i < $rows; $i++) { 
            for ($j=0; $j < $columns; $j++) {
                // More density, more dead cells
                $randomNumber = random_int(0, $density);
                if ($randomNumber == 0)
                    $grid[$i][$j]->setAlive();
            }
        }
    }
}