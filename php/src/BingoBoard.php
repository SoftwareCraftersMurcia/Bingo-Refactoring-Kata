<?php

declare(strict_types=1);

namespace Kata;

use RuntimeException;

class BingoBoard
{
    private array $cells;

    private array $marked;

    public function __construct(int $aWidth, int $aHeight)
    {
        $this->cells = array_fill(0, $aWidth, array_fill(0, $aHeight, null));
        $this->marked = array_fill(0, $aHeight, array_fill(0, $aHeight, false));
    }

    public function defineCell(int $x, int $y, string $value): void
    {
        if ($this->cells[$x][$y] !== null) {
            throw new RuntimeException("cell already defined");
        }

        for ($c = 0; $c < count($this->cells); $c++) {
            for ($r = 0; $r < count($this->cells[$c]); $r++) {
                if ($value === $this->cells[$c][$r]) {
                    throw new RuntimeException("$value already present at $c,$r");
                }
            }
        }

        $this->cells[$x][$y] = $value;
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
