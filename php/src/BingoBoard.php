<?php

namespace Kata;

use RuntimeException;

class BingoBoard
{
    /** @var array[int] */
    private array $oldCells;
    /** @var array[bool] */
    private array $marked;
    /** @var array[Cell] */
    private array $cells;

    public function __construct(int $aWidth, int $aHeight)
    {
        $this->oldCells = array_fill(0, $aWidth, array_fill(0, $aHeight, null));
        $this->marked = array_fill(0, $aHeight, array_fill(0, $aHeight, false));
        $this->cells = array_fill(0, $aWidth, array_fill(0, $aHeight, new Cell()));

    }

    public function defineCell(int $x, int $y, string $value): void
    {
        if ($this->oldCells[$x][$y] !== null) {
            throw new RuntimeException("cell already defined");
        }

        foreach ($this->oldCells as $numberOfColumn => $colum) {
            foreach ($colum as $numberOfRow => $row) {
                if ($value === $row) {
                    throw new RuntimeException("$value already present at $numberOfColumn,$numberOfRow");
                }
            }
        }

        $this->oldCells[$x][$y] = $value;
    }

    public function markCell(int $x, int $y): void
    {
        if (!$this->isInitialized()) {
            throw new RuntimeException("board not initialized");
        }
        $this->marked[$x][$y] = true;
    }

    public function is_marked(int $x, int $y): bool
    {
        return $this->marked[$x][$y];
    }

    public function isInitialized(): bool
    {
        foreach ($this->oldCells as $row) {
            foreach ($row as $col) {
                if ($col === null) {
                    return false;
                }
            }
        }
        return true;
    }
}
