<?php

use PHPUnit\Framework\TestCase;

use GameOfLife\Domain\Universe;
use GameOfLife\Application\UpdateUniverse;

class UpdateUniverseTest extends TestCase
{
    protected $rows;
    protected $columns;
    protected $density;
    protected $universe;

    protected function setUp(): void
    {
        $this->rows = 3;
        $this->columns = 4;
        $this->density = 4;
        $this->universe = new Universe($this->rows, $this->columns, $this->density);
    }

    public function testUpdateUniverse()
    {
        /*
         [*][*][ ][ ]      [*][*][ ][ ]
         [*][ ][ ][ ]  =>  [ ][ ][*][ ]
         [*][*][*][ ]      [*][*][ ][ ]

         [1][0] dies because it has >3 neighbours alive
         [2][2] dies because it has <2 neighbours alive
         The other alives don't die because they have 2 or 3 neighbours alive
         [1][2] lives because it has 3 neighbours alive
         The other deads don't live because they have less than 3 or more than 3 neighbours alive
         */
        $this->universe->getGrid()[0][0]->setAlive();
        $this->universe->getGrid()[0][1]->setAlive();
        $this->universe->getGrid()[1][0]->setAlive();
        $this->universe->getGrid()[2][0]->setAlive();
        $this->universe->getGrid()[2][1]->setAlive();
        $this->universe->getGrid()[2][2]->setAlive();

        $updateUniverse = new UpdateUniverse($this->universe);
        $nextGeneration = $updateUniverse->update();

        $this->assertFalse($nextGeneration->getGrid()[0][0]->isDead(), 'Must be the same: [0][0].');
        $this->assertFalse($nextGeneration->getGrid()[0][1]->isDead(), 'Must be the same: [0][1].');
        $this->assertTrue($nextGeneration->getGrid()[0][2]->isDead(), 'Must be the same: [0][2].');
        $this->assertTrue($nextGeneration->getGrid()[0][3]->isDead(), 'Must be the same: [0][3].');
        $this->assertTrue($nextGeneration->getGrid()[1][0]->isDead(), 'Must be the same: [1][0].');
        $this->assertTrue($nextGeneration->getGrid()[1][1]->isDead(), 'Must be the same: [1][1].');
        $this->assertFalse($nextGeneration->getGrid()[1][2]->isDead(), 'Must be the same: [1][2].');
        $this->assertTrue($nextGeneration->getGrid()[1][3]->isDead(), 'Must be the same: [1][3].');
        $this->assertFalse($nextGeneration->getGrid()[2][0]->isDead(), 'Must be the same: [2][0].');
        $this->assertFalse($nextGeneration->getGrid()[2][1]->isDead(), 'Must be the same: [2][1].');
        $this->assertTrue($nextGeneration->getGrid()[2][2]->isDead(), 'Must be the same: [2][2].');
        $this->assertTrue($nextGeneration->getGrid()[2][3]->isDead(), 'Must be the same: [2][3].');
    }
}