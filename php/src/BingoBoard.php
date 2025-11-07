<?php

namespace Kata;

use RuntimeException;

class BingoBoard
{
    private array $cells;
    private array $marked;

    public function __construct($aWidth, $aHeight)
    {
        $this->cells = array_fill(0, $aWidth, array_fill(0, $aHeight, null));
        $this->marked = array_fill(0, $aHeight, array_fill(0, $aHeight, false));
    }

    public function defineCell($x, $y, $value): void
    {
        if ($this->cells[$x][$y] !== null) {
            throw new RuntimeException("cell already defined");
        }

        foreach ($this->cells as $c => $cValue) {
            foreach ($cValue as $r => $rValue) {
                if ($value === $rValue) {
                    throw new RuntimeException("$value already present at $c,$r");
                }
            }
        }

        $this->cells[$x][$y] = $value;
    }

    public function markCell($x, $y): void
    {
        if (!$this->isInitialized()) {
            throw new RuntimeException("board not initialized");
        }
        $this->marked[$x][$y] = true;
    }

    public function is_marked($x, $y): bool
    {
        return $this->marked[$x][$y];
    }

    public function isInitialized(): bool
    {
        foreach ($this->cells as $row) {
            foreach ($row as $col) {
                if ($col === null) {
                    return false;
                }
            }
        }
        return true;
    }
}
