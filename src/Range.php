<?php

declare(strict_types=1);

namespace Haikara\Pagination;

use Haikara\Pagination\Exceptions\RangeException;

class Range implements RangeInterface
{
    /**
     * @var int
     */
    protected $value;

    public function __construct(int $value)
    {
        if ($value < 1) {
            throw new RangeException(static::class . 'には正の整数を指定してください。');
        }
        $this->value = $value;
    }

    public function get(): int
    {
        return $this->value;
    }

    /**
     * @param Current $current
     * @param int $display
     * @param int $total
     * @return int[]
     */
    public function getPages(Current $current, int $display, int $total): array {
        if ($total === 0) {
            return [];
        }

        if ($total <= $display) {
            return [1];
        }

        $diff = (int)floor($this->value / 2);

        $range_begin = ($this->value % 2 !== 0)
            ? $current->get() - $diff
            : $current->get() - $diff + 1;

        if ($range_begin < 1) {
            $range_begin = 1;
        }

        $range_end = $current->get() + $diff;

        if ($range_end < $this->value) {
            $range_end = $this->value;
        }

        // 総件数から算出される最終ページ
        $actual_last = (int)ceil($total / $display);

        $max_begin = $actual_last - $this->value + 1;

        if ($max_begin < 1) {
            $max_begin = 1;
        }

        return range(
            min($range_begin, $max_begin),
            min($range_end, $actual_last)
        );
    }
}
