<?php
declare(strict_types=1);

namespace Kata;

final class Cell
{
    public function __construct(public ?string $value, private bool $marked)
    {
    }

    public function isMarked(): bool
    {
        return $this->marked;
    }

    public function mark(): void
    {
        $this->marked = true;
    }
}