<?php

declare(strict_types=1);

namespace Kata;

use RuntimeException;

class BingoBoard
{
    /** @var list<list<string|null>> */
    private array $cells;

    /** @var list<list<bool>> */
    private array $marked;

    public function __construct(int $width, int $height)
    {
        $this->cells = array_fill(0, $width, array_fill(0, $height, null));
        $this->marked = array_fill(0, $height, array_fill(0, $height, false));
    }

    public function defineCell(int $positionX, int $positionY, string $value): void
    {
        $this->ensureEmptyCell($positionX,$positionY);

        foreach ($this->cells as $c => $cValue) {
            foreach ($cValue as $r => $rValue) {
                if ($value === $rValue) {
                    throw new RuntimeException("$value already present at $c,$r");
                }
            }
        }

        $this->cells[$positionX][$positionY] = $value;
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

    private function ensureEmptyCell(int $positionX, int $positionY): void
    {
        if ($this->cells[$positionX][$positionY] !== null) {
            throw new RuntimeException("cell already defined");
        }
    }
}
