<?php

declare(strict_types=1);

namespace Kata;

final class Cell
{
    public function __construct(
        public string $value,
        public bool $marked = false,
    ) {
    }

    public function mark(): void
    {
        $this->marked = true;
    }

    public function isMarked(): bool
    {
        return $this->marked;
    }

    public function equals(?Cell $other): bool
    {
        return $this->value === $other?->value;
    }
}
