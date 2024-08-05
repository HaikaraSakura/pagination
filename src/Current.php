<?php

declare(strict_types=1);

namespace Haikara\Pagination;

use JsonSerializable;
use Haikara\Pagination\Exceptions\CurrentException;

class Current implements CurrentInterface, JsonSerializable
{
    /**
     * @throws CurrentException
     */
    public function __construct(protected readonly int $value)
    {
        if (!self::isPositiveInteger($this->value)) {
            throw new CurrentException();
        }
    }

    /**
     * @param int $current
     * @param int $last
     * @return CurrentInterface
     */
    public static function createWithinRange(int $current, int $last): CurrentInterface
    {
        return new static(match (true) {
            $last < self::FIRST,
            $current < self::FIRST => self::FIRST,
            $current > $last => $last,
            default => $current
        });
    }

    private static function isPositiveInteger(int $current): bool
    {
        return $current >= self::FIRST;
    }

    public function get(): int
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function jsonSerialize(): int
    {
        return $this->value;
    }
}
