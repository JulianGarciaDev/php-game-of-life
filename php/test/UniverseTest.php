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

    public function testConstructor()
    {
        $universe = new Universe($this->rows, $this->columns, $this->density);
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
}