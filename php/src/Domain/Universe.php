<?php

declare(strict_types=1);

namespace GameOfLife\Domain;

use GameOfLife\Domain\Cell;

class Universe
{
    private int $rows;
    private int $columns;
    private array $grid;

    public function __construct(int $rows, int $columns, int $density)
    {
        $this->rows = $rows;
        $this->columns = $columns;

        for ($i=0; $i < $this->rows; $i++) { 
            for ($j=0; $j < $this->columns; $j++) {
                $cell = new Cell();
                // More density, more dead cells
                $randomNumber = random_int(0, $density);
                if ($randomNumber == 0) $cell->setAlive();
                $this->grid[$i][$j] = $cell;
            }
        }
    }

    public function getGrid(): array
    {
        return $this->grid;
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

}