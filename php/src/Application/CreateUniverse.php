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
        return $this->universe;
    }
}