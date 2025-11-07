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

    public function defineCell(int $x, int $y, string $value): void
    {
        foreach ($this->cells as $coordinate => $cell) {
            $coordinate1 = Coordinate::fromString($coordinate);
            if ($cell->value === $value && $coordinate1->column !== $x && $coordinate1->row !== $y) {
                throw new RuntimeException("$value already present at $coordinate1->column,$coordinate1->row");
            }
        }

        $this->cells[(string)new Coordinate($x, $y)]->setValue($value);
    }

    public function markCell(int $x, int $y): void
    {
        if (!$this->isInitialized()) {
            throw new RuntimeException("board not initialized");
        }
        $this->cells[(string)new Coordinate($x, $y)]->mark();
    }

    public function is_marked(int $x, int $y): bool
    {
        return $this->cells[(string)new Coordinate($x, $y)]->isMarked();
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
