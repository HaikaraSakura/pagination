<?php

declare(strict_types=1);

namespace Haikara\Pagination;

interface RangeInterface
{
    /**
     * @return int
     */
    public function get(): int;

    /**
     * @param Current $current
     * @param int $display
     * @param int $total
     * @return int[]
     */
    public function getPages(Current $current, int $display, int $total): array;
}
