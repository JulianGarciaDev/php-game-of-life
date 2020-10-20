<?php

use PHPUnit\Framework\TestCase;

use GameOfLife\Domain\Cell;

class CellTest extends TestCase
{
    protected $CHAR_DEAD;
    protected $CHAR_ALIVE;

    protected function setUp(): void
    {
        $this->CHAR_DEAD = '_';
        $this->CHAR_ALIVE = 'X';
    }

    public function testConstruct()
    {
        $cell = new Cell();
        $this->assertSame(true, $cell->isDead(), 'Must be the same.');
    }

    public function testSetDead()
    {
        $cell = new Cell();
        $cell->setDead();
        $this->assertSame(true, $cell->isDead(), 'Must be the same.');
    }

    public function testSetAlive()
    {
        $cell = new Cell();
        $cell->setAlive();
        $this->assertSame(false, $cell->isDead(), 'Must be the same.');
    }

    public function testPrintDead()
    {
        $cell = new Cell();
        $cell->setDead();
        $this->assertSame($this->CHAR_DEAD, $cell->printState(), 'Must be the same.');
    }

    public function testPrintAlive()
    {
        $cell = new Cell();
        $cell->setAlive();
        $this->assertSame($this->CHAR_ALIVE, $cell->printState(), 'Must be the same.');
    }
}