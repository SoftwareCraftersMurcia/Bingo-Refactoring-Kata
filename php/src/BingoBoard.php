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
                $this->cells[(string)new Coordinate($j, $i)] = new Cell(null, false);
            }
        }
    }

    public function defineCell(Coordinate $coordinate, string $value): void
    {
        foreach ($this->cells as $strCoordinate => $cell) {
            $coordinate1 = Coordinate::fromString($strCoordinate);
            if ($cell->value === $value && $coordinate1 != $coordinate) {
                throw new RuntimeException("$value already present at $coordinate1->column,$coordinate1->row");
            }
        }

        $this->cells[(string)$coordinate]->setValue($value);
    }

    public function markCell(Coordinate $coordinate): void
    {
        if (!$this->isInitialized()) {
            throw new RuntimeException("board not initialized");
        }
        $this->cells[(string)$coordinate]->mark();
    }

    public function isMarked(Coordinate $coordinate): bool
    {
        return $this->cells[(string)$coordinate]->isMarked();
    }

    public function isInitialized(): bool
    {
        foreach ($this->cells as $cell) {
            if ($cell->value === null) {
                return false;
            }
        }
        return true;
    }
}
