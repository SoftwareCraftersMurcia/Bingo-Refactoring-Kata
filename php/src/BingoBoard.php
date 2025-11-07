<?php

namespace Kata;

use RuntimeException;
use SplObjectStorage;

class BingoBoard
{
    /** @var Cell[][] */
    private array $oldCells;
    /** @var array<Coordinate,Cell> */
    private array $cells;

    public function __construct(int $aWidth, int $aHeight)
    {
        $this->oldCells = [];
        $this->cells = [];
        for ($j = 0; $j < $aWidth; $j++) {
            for ($i = 0; $i < $aHeight; $i++) {
                $this->oldCells[$j][$i] = new Cell(null, false);
                $this->cells[(string) new Coordinate($j, $i)] = new Cell(null, false);
            }
        }
    }

    public function defineCell(int $x, int $y, string $value): void
    {
        foreach ($this->oldCells as $numberOfColumn => $colum) {
            foreach ($colum as $numberOfRow => $row) {
                if ($value === $row->value && $x !== $numberOfColumn && $y !== $numberOfRow) {
                    throw new RuntimeException("$value already present at $numberOfColumn,$numberOfRow");
                }
            }
        }

        $this->oldCells[$x][$y]->setValue($value);
        $this->cells[(string) new Coordinate($x, $y)]->setValue($value);
    }

    public function markCell(int $x, int $y): void
    {
        if (!$this->isInitialized()) {
            throw new RuntimeException("board not initialized");
        }
        $this->oldCells[$x][$y]->mark();
        $this->cells[(string) new Coordinate($x, $y)]->mark();
    }

    public function is_marked(int $x, int $y): bool
    {
        return $this->oldCells[$x][$y]->isMarked();
    }

    public function isInitialized(): bool
    {
        foreach ($this->oldCells as $row) {
            foreach ($row as $col) {
                if ($col->value === null) {
                    return false;
                }
            }
        }
        return true;
    }
}
