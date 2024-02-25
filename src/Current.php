<?php

declare(strict_types=1);

namespace Haikara\Pagination;

use JsonSerializable;
use Haikara\Pagination\Exceptions\CurrentException;

class Current implements CurrentInterface, JsonSerializable
{
    /**
     * @var int
     */
    protected $value;

    /**
     * @throws CurrentException
     */
    public function __construct(int $current)
    {
        if (!self::isPositiveInteger($current)) {
            throw new CurrentException();
        }

        $this->value = $current;
    }

    public static function createWithinRange(int $current, int $last): CurrentInterface
    {
        if (
            $last < self::FIRST
            || $current < self::FIRST
        ) {
            return new static(self::FIRST);
        }

        if ($current > $last) {
            return new static($last);
        }

        return new static($current);
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

    /**
     * json_encode()された場合に呼ばれる。
     * valueを返す。
     */
    public function jsonSerialize(): int
    {
        return $this->value;
    }
}
