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
        $this->assertTrue($cell->isDead(), 'Must be the same.');
    }

    public function testSetDead()
    {
        $cell = new Cell();
        $cell->setDead();
        $this->assertTrue($cell->isDead(), 'Must be the same.');
    }

    public function testSetAlive()
    {
        $cell = new Cell();
        $cell->setAlive();
        $this->assertFalse($cell->isDead(), 'Must be the same.');
    }
}