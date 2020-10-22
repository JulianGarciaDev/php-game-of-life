<?php

use PHPUnit\Framework\TestCase;

use GameOfLife\Domain\Universe;

class UniverseTest extends TestCase
{
    protected $rows;
    protected $columns;
    protected $density;

    protected function setUp(): void
    {
        $this->rows = 10;
        $this->columns = 15;
        $this->density = 4;
    }

    public function testConstructorCellsDead()
    {
        $universe = new Universe($this->rows, $this->columns, $this->density);
        
        for ($i=0; $i < $this->rows; $i++) { 
            for ($j=0; $j < $this->columns; $j++) {
                $this->assertTrue($universe->getGrid()[$i][$j]->isDead(), 'Must be the same.');
            }
        }

        $this->assertSame($this->rows, count($universe->getGrid()), 'Must be the same.');
        $this->assertSame($this->columns, count($universe->getGrid()[0]), 'Must be the same.');
    }

    public function testGetRows()
    {
        $universe = new Universe($this->rows, $this->columns, $this->density);
        $this->assertSame($this->rows, $universe->getRows(), 'Must be the same.');
    }

    public function testGetColumns()
    {
        $universe = new Universe($this->rows, $this->columns, $this->density);
        $this->assertSame($this->columns, $universe->getColumns(), 'Must be the same.');
    }

    public function testGetDensity()
    {
        $universe = new Universe($this->rows, $this->columns, $this->density);
        $this->assertSame($this->density, $universe->getDensity(), 'Must be the same.');
    }
}