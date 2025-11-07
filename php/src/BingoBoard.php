<?php

namespace Kata;

use RuntimeException;

class BingoBoard
{
    /** @var array<string,Cell> */
    private array $cells;

    public function __construct(int $aWidth, int $aHeight)
    {
        $this->cells = [];
        for ($j = 0; $j < $aWidth; $j++) {
            for ($i = 0; $i < $aHeight; $i++) {
                $this->cells[(string)new Coordinate($j, $i)] = new Cell();
            }
        }
    }

    public function defineCell(Coordinate $coordinate, string $value): void
    {
        $this->ensureValueNotPresent($value);
        $this->cellAt($coordinate)->setValue($value);
    }

    public function markCell(Coordinate $coordinate): void
    {
        $this->cellAt($coordinate)->mark();
    }

    public function isMarked(Coordinate $coordinate): bool
    {
        return $this->cellAt($coordinate)->isMarked();
    }

    public function isInitialized(): bool
    {
        return array_all($this->cells, fn(Cell $cell) => $cell->isInitialized());
    }

    private function cellAt(Coordinate $coordinate): Cell
    {
        return $this->cells[(string)$coordinate];
    }

    private function ensureValueNotPresent(string $value): void
    {
        foreach ($this->cells as $strCoordinate => $cell) {
            if ($cell->contains($value)) {
                $coordinate1 = Coordinate::fromString($strCoordinate);
                throw new RuntimeException("$value already present at $coordinate1->column,$coordinate1->row");
            }
        }
    }
}
