<?php

declare(strict_types=1);

namespace Haikara\Pagination;

class PaginationFactory implements PaginationFactoryInterface
{
    /**
     * @inheritDoc
     */
    public static function create(
        int $range,
        int $display,
        int $current,
        int $total
    ): PaginationInterface {
        return new Pagination($range, $display, $current, $total);
    }
}