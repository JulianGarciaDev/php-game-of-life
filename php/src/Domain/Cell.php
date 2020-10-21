<?php

declare(strict_types=1);

namespace GameOfLife\Domain;

class Cell
{
    private string $state;
    private const STATE_DEAD = 'Dead';
    private const STATE_ALIVE = 'Alive';

    public function __construct()
    {
        $this->state = self::STATE_DEAD;
    }

    private function getState(): string
    {
        return $this->state;
    }

    private function setState(string $state)
    {
        $this->state = $state;
    }

    public function setDead()
    {
        $this->setState(self::STATE_DEAD);
    }

    public function setAlive()
    {
        $this->setState(self::STATE_ALIVE);
    }

    public function isDead(): bool
    {
        return ($this->getState() == self::STATE_DEAD);
    }

}
