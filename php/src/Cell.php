<?php
declare(strict_types=1);

namespace Kata;

final class Cell
{
    public function __construct(public ?string $value, public bool $marked)
    {
    }

    public function isMarked(): bool
    {
        return $this->marked;
    }
}