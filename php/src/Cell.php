<?php
declare(strict_types=1);

namespace Kata;

use RuntimeException;

final class Cell
{
    public function __construct(public ?string $value, private bool $marked)
    {
    }

    public function setValue(string $value): void
    {
        if ($this->value !== null) {
            throw new RuntimeException("cell already defined");
        }
        $this->value = $value;
    }

    public function isMarked(): bool
    {
        return $this->marked;
    }

    public function mark(): void
    {
        $this->marked = true;
    }

    public function isInitialized(): bool
    {
        return $this->value !== null;
    }
}