<?php
declare(strict_types=1);

namespace Kata;

final class Coordinate
{

    public function __construct(public readonly int $column, public readonly int $row)
    {
    }

    public function __toString(): string
    {
        return $this->column . ',' . $this->row;
    }

    public static function fromString(string $coordinate): self
    {
        $parts = explode(',', $coordinate);
        return new self((int)$parts[0], (int)$parts[1]);
    }

}