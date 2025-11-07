<?php

namespace Kata;

use RuntimeException;

class BingoBoard
{
    /** @var array[int] */
    private array $oldCells;
    /** @var Cell[][] */
    private array $cells;

    public function __construct(int $aWidth, int $aHeight)
    {
        $this->oldCells = array_fill(0, $aWidth, array_fill(0, $aHeight, null));
        $cells = [];
        for ($j = 0; $j < $aWidth; $j++) {
            for ($i = 0; $i < $aHeight; $i++) {
                $cells[$j][$i] = new Cell(null, false);
            }
        }
        $this->cells = $cells;
    }

    public function defineCell(int $x, int $y, string $value): void
    {
        if ($this->cells[$x][$y]->value !== null) {
            throw new RuntimeException("cell already defined");
        }

        foreach ($this->cells as $numberOfColumn => $colum) {
            foreach ($colum as $numberOfRow => $row) {
                if ($value === $row->value) {
                    throw new RuntimeException("$value already present at $numberOfColumn,$numberOfRow");
                }
            }
        }

        $this->oldCells[$x][$y] = $value;
        $this->cells[$x][$y]->value = $value;
    }

    public function markCell(int $x, int $y): void
    {
        if (!$this->isInitialized()) {
            throw new RuntimeException("board not initialized");
        }
        $this->cells[$x][$y]->marked = true;
    }

    public function is_marked(int $x, int $y): bool
    {
        return $this->cells[$x][$y]->marked;
    }

    public function isInitialized(): bool
    {
        foreach ($this->cells as $row) {
            foreach ($row as $col) {
                if ($col->value === null) {
                    return false;
                }
            }
        }
        return true;
    }
}
