<?php

declare(strict_types=1);

namespace GameOfLife\Domain;

use GameOfLife\Domain\Cell;

class Universe
{
    private int $rows;
    private int $columns;
    private int $density;
    private array $grid;

    public function __construct(int $rows, int $columns, int $density)
    {
        $this->rows = $rows;
        $this->columns = $columns;
        $this->density = $density;

        for ($i=0; $i < $this->rows; $i++) { 
            for ($j=0; $j < $this->columns; $j++) {
                $this->grid[$i][$j] = new Cell();
            }
        }
    }

    public function getRows(): int
    {
        return $this->rows;
    }

    public function getColumns(): int
    {
        return $this->columns;
    }

    public function getDensity(): int
    {
        return $this->density;
    }

    public function getGrid(): array
    {
        return $this->grid;
    }
}