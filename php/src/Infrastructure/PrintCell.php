<?php

declare(strict_types=1);

namespace GameOfLife\Infrastructure;

use GameOfLife\Domain\Cell;

class PrintCell
{
    private Cell $cell;

    public function __construct(Cell $cell)
    {
        $this->cell = $cell;
    }

    public function print(): string
    {
        $char = 'X';
        if ($this->cell->isDead()) $char = '_';
        return $char;
    }
}