<?php

declare(strict_types=1);

namespace Haikara\Pagination;

interface CurrentInterface
{
    public const FIRST = 1;

    public function __construct(int $current);

    public static function createWithinRange(int $current, int $last): CurrentInterface;

    public function get(): int;

    public function __toString(): string;

    /**
     * json_encode()された場合に呼ばれる。
     * valueを返す。
     */
    public function jsonSerialize(): int;
}
