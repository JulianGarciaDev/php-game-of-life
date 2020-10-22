<?php

use PHPUnit\Framework\TestCase;

use GameOfLife\Domain\Cell;

class CellTest extends TestCase
{
    protected $cell;

    protected function setUp(): void
    {
        $this->cell = new Cell();
    }

    public function testConstructCellDead()
    {
        $this->assertTrue($this->cell->isDead(), 'Must be the same.');
    }

    public function testSetDead()
    {
        $this->cell->setDead();
        $this->assertTrue($this->cell->isDead(), 'Must be the same.');
    }

    public function testSetAlive()
    {
        $this->cell->setAlive();
        $this->assertFalse($this->cell->isDead(), 'Must be the same.');
    }
}