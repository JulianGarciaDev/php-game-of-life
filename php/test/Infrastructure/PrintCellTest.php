<?php

use PHPUnit\Framework\TestCase;

use GameOfLife\Infrastructure\PrintCell;
use GameOfLife\Domain\Cell;

class PrintCellTest extends TestCase
{
    protected $CHAR_DEAD;
    protected $CHAR_ALIVE;
    protected $cell;
    protected $printCell;

    protected function setUp(): void
    {
        $this->CHAR_DEAD = '_';
        $this->CHAR_ALIVE = 'X';
        $this->cell = new Cell();
        $this->printCell = new PrintCell($this->cell);
    }

    public function testPrintDead()
    {
        $this->cell->setDead();
        $this->assertSame($this->CHAR_DEAD, $this->printCell->print(), 'Must be the same.');
    }

    public function testPrintAlive()
    {
        $this->cell->setAlive();
        $this->assertSame($this->CHAR_ALIVE, $this->printCell->print(), 'Must be the same.');
    }
}