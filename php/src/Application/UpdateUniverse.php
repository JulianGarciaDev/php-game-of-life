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

                $currentCell = $this->universe->getGrid()[$i][$j];
                $currentCellIsDead = $currentCell->isDead();
        
                $validNeighbours = $this->checkNeighbours($i, $j);
                $neighboursAlive = 0;

                foreach ($validNeighbours as $neighbour){
                    if (!$neighbour->isDead()) $neighboursAlive++;
                }

                if ($currentCellIsDead){
                    if ($neighboursAlive == 3)
                        $toAlive[] = $currentCell;

                } else { // Current cell is alive
                    if ($neighboursAlive < 2 || $neighboursAlive > 3) {
                        $toDead[] = $currentCell;
                    } else {
                        $toAlive[] = $currentCell;
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
        $validNeighbours = [];

        for ($r=-1; $r <= 1; $r++) { 
            for ($c=-1; $c <= 1; $c++) { 
                $neighbourRow = $row + $r;
                $neighbourColumn = $column + $c;

                $isValid = true;

                if (
                    ($r == 0 && $c == 0) ||
                    ($neighbourRow < 0) || ($neighbourColumn < 0) ||
                    ($neighbourRow >= $this->universe->getRows()) ||
                    ($neighbourColumn >= $this->universe->getColumns())
                )
                {
                    $isValid = false;
                }

                if ($isValid)
                    $validNeighbours[] = $this->universe->getGrid()[$neighbourRow][$neighbourColumn];
            }
        }

        return $validNeighbours;
    }
}