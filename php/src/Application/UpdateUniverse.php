<?php

declare(strict_types=1);

namespace GameOfLife\Application;

use GameOfLife\Domain\Universe;

class UpdateUniverse
{
    private Universe $universe;

    public function __construct(Universe $universe)
    {
        $this->universe = $universe;
    }

    public function update(): Universe
    {
        $toDead = [];
        $toAlive = [];

        for ($i=0; $i < $this->universe->getRows(); $i++) { 
            for ($j=0; $j < $this->universe->getColumns(); $j++) {

                $current_cell = $this->universe->getGrid()[$i][$j];
                $current_cell_is_dead = $current_cell->isDead();
        
                $valid_neighbours = $this->checkNeighbours($i, $j);
                $neighbours_alive = 0;

                foreach ($valid_neighbours as $neighbour){
                    if (!$neighbour->isDead()) $neighbours_alive++;
                }

                if ($current_cell_is_dead){
                    if ($neighbours_alive == 3)
                        $toAlive[] = $current_cell;

                } else { // Current cell is alive
                    if ($neighbours_alive < 2 || $neighbours_alive > 3) {
                        $toDead[] = $current_cell;
                    } else {
                        $toAlive[] = $current_cell;
                    }
                }

            }
        }

        // Update cells status
        foreach ($toAlive as $cell){
            $cell->setAlive();
        }

        foreach ($toDead as $cell){
            $cell->setDead();
        }

        return $this->universe;
    }

    private function checkNeighbours(int $row, int $column): array
    {
        $valid_neighbours = [];

        for ($r=-1; $r <= 1; $r++) { 
            for ($c=-1; $c <= 1; $c++) { 
                $neighbour_row = $row + $r;
                $neighbour_column = $column + $c;

                $is_valid = true;

                if (
                    ($r == 0 && $c == 0) ||
                    ($neighbour_row < 0) || ($neighbour_column < 0) ||
                    ($neighbour_row >= $this->universe->getRows()) ||
                    ($neighbour_column >= $this->universe->getColumns())
                )
                {
                    $is_valid = false;
                }

                if ($is_valid)
                    $valid_neighbours[] = $this->universe->getGrid()[$neighbour_row][$neighbour_column];
            }
        }

        return $valid_neighbours;
    }
}