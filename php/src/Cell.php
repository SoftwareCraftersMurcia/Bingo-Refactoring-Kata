<?php
declare(strict_types=1);

namespace Kata;

use RuntimeException;

final class Cell
{
    public function __construct(private ?string $value = null, private bool $marked = false)
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
        if (!$this->isInitialized()) {
            throw new RuntimeException("cell not initialized");
        }
        $this->marked = true;
    }

    public function contains(string $value): bool
    {
        return $this->value === $value;
    }

    public function isInitialized(): bool
    {
        return $this->value !== null;
    }
}