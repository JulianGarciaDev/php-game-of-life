<?php

declare(strict_types=1);

namespace GameOfLife\Application;

use GameOfLife\Domain\Universe;

class UpdateUniverse
{
    private const MIN_NEIGHBORS_FOR_ALIVE = 2;
    private const MAX_NEIGHBORS_FOR_ALIVE = 3;
    private const NEIGHBORS_FOR_RESURRECTION = 3;

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
        
                $validNeighbors = $this->checkNeighbors($i, $j);

                $neighborsAlive = 0;

                foreach ($validNeighbors as $neighbor){
                    if (!$neighbor->isDead())
                        $neighborsAlive++;
                }

                if ($this->cellToDie($currentCellIsDead, $neighborsAlive)) {
                    $toDead[] = $currentCell;

                } elseif ($this->cellToLive($currentCellIsDead, $neighborsAlive)) {
                    $toAlive[] = $currentCell;
                }
            }
        }

        $this->updateCells($toAlive, $toDead);

        return $this->universe;
    }

    private function cellToDie(bool $cellIsDead, int $neighborsAlive): bool
    {
        return (!$cellIsDead && 
                ($neighborsAlive < self::MIN_NEIGHBORS_FOR_ALIVE || $neighborsAlive > self::MAX_NEIGHBORS_FOR_ALIVE)
            );
    }

    private function cellToLive(bool $cellIsDead, int $neighborsAlive): bool
    {
        return ($cellIsDead && 
                ($neighborsAlive == self::NEIGHBORS_FOR_RESURRECTION)
            );
    }

    private function updateCells(array $toAlive, array $toDead): void
    {
        foreach ($toAlive as $cell){
            $cell->setAlive();
        }

        foreach ($toDead as $cell){
            $cell->setDead();
        }
    }

    private function checkNeighbors(int $row, int $column): array
    {
        $validNeighbors = [];

        for ($rowOffset=-1; $rowOffset <= 1; $rowOffset++) { 
            for ($columnOffset=-1; $columnOffset <= 1; $columnOffset++) {

                $neighborRow = $row + $rowOffset;
                $neighborColumn = $column + $columnOffset;

                if ($this->neighborIsValid($rowOffset, $columnOffset, $neighborRow, $neighborColumn))
                    $validNeighbors[] = $this->universe->getGrid()[$neighborRow][$neighborColumn];
            }
        }

        return $validNeighbors;
    }

    private function neighborIsValid(int $rowOffset, int $columnOffset, int $neighborRow, int $neighborColumn): bool
    {
        return !(
            $this->neighborIsCurrentCell($rowOffset, $columnOffset) ||
            $this->neighborOutUniverse($neighborRow, $neighborColumn)
        );
    }

    private function neighborIsCurrentCell(int $row, int $column): bool
    {
        return ($row == 0 && $column == 0);
    }

    private function neighborOutUniverse(int $neighborRow, int $neighborColumn): bool
    {
        return (
            $this->neighborOutUniverseLeft($neighborRow) ||
            $this->neighborOutUniverseTop($neighborColumn) ||
            $this->neighborOutUniverseRight($neighborRow) ||
            $this->neighborOutUniverseBottom($neighborColumn)
        );
    }

    private function neighborOutUniverseLeft(int $neighborRow): bool
    {
        return ($neighborRow < 0);
    }

    private function neighborOutUniverseTop(int $neighborColumn): bool
    {
        return ($neighborColumn < 0);
    }

    private function neighborOutUniverseRight(int $neighborRow): bool
    {
        return ($neighborRow >= $this->universe->getRows());
    }

    private function neighborOutUniverseBottom(int $neighborColumn): bool
    {
        return ($neighborColumn >= $this->universe->getColumns());
    }
}