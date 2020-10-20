<?php

use PHPUnit\Framework\TestCase;

use GameOfLife\Domain\Cell;
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
        $this->rows = 10;
        $this->columns = 15;
        $this->density = 4;
        $this->universe = new Universe($this->rows, $this->columns, $this->density);
    }

    public function testUpdateUniverseTopLeft()
    {
        $is_dead = true;

        if (
            (
                ($this->universe->getGrid()[0][0]->isDead()) &&
                (!$this->universe->getGrid()[0][1]->isDead()) &&
                (!$this->universe->getGrid()[1][0]->isDead()) &&
                (!$this->universe->getGrid()[1][1]->isDead())
            ) ||
            (
                (!$this->universe->getGrid()[0][0]->isDead()) &&
                (!$this->universe->getGrid()[0][1]->isDead()) &&
                (!$this->universe->getGrid()[1][0]->isDead()) &&
                (!$this->universe->getGrid()[1][1]->isDead())
            ) ||
            (
                (!$this->universe->getGrid()[0][0]->isDead()) &&
                ($this->universe->getGrid()[0][1]->isDead()) &&
                (!$this->universe->getGrid()[1][0]->isDead()) &&
                (!$this->universe->getGrid()[1][1]->isDead())
            ) ||
            (
                (!$this->universe->getGrid()[0][0]->isDead()) &&
                (!$this->universe->getGrid()[0][1]->isDead()) &&
                ($this->universe->getGrid()[1][0]->isDead()) &&
                (!$this->universe->getGrid()[1][1]->isDead())
            ) ||
            (
                (!$this->universe->getGrid()[0][0]->isDead()) &&
                (!$this->universe->getGrid()[0][1]->isDead()) &&
                (!$this->universe->getGrid()[1][0]->isDead()) &&
                ($this->universe->getGrid()[1][1]->isDead())
            )
        )
        {
            $is_dead = false;
        }

        $update_universe = new UpdateUniverse($this->universe);
        $new_universe = $update_universe->update();

        $this->assertSame($is_dead, $new_universe->getGrid()[0][0]->isDead(), 'Must be the same.');
    }
}