<?php

declare(strict_types=1);

namespace Haikara\Pagination;

use Generator;

/**
 * ページネーションクラス。ページ番号の配列を生成する。
 */
class Pagination implements PaginationInterface
{
    protected RangeInterface $range;
    protected int $display;
    protected CurrentInterface $current;
    protected int $total;
    protected int $last;

    /**
     * @param int $range ページネーションとして表示するページ番号の数
     * @param int $display 一覧に表示する数。limit値。
     * @param int $current ユーザが指定した現在のページ番号
     * @param int $total 検索に一致した全件数
     */
    public function __construct(int $range, int $display, int $current, int $total) {
        $this->range = new Range($range);
        $this->display = $display;
        $this->total = $total;

        $last = (int)ceil($total / $display);
        $this->last = ($last > 0) ? $last : self::FIRST;

        $this->current = Current::createWithinRange($current, $this->last);
    }

    /** @inheritDoc */
    public function getPages(): array
    {
        return $this->range->getPages(
            $this->current,
            $this->display,
            $this->total
        );
    }

    /** @inheritDoc */
    public function getCurrent(): int
    {
        return $this->current->get();
    }

    /** @inheritDoc */
    public function getDisplayFirst(): int
    {
        if ($this->total === 0) {
            return 0;
        }

        return $this->display * ($this->current->get() - 1) + 1;
    }

    /** @inheritDoc */
    public function getDisplayLast(): int
    {
        if ($this->total === 0) {
            return 0;
        }

        $last = $this->display * $this->current->get();
        return min($last, $this->total);
    }

    /** @inheritDoc */
    public function getTotal(): int {
        return $this->total;
    }

    /** @inheritDoc */
    public function getLimit(): int {
        return $this->display;
    }

    /** @inheritDoc */
    public function isCurrent(int $number): bool
    {
        return $this->current->get() === $number;
    }

    /** @inheritDoc */
    public function isFirst(): bool
    {
        return $this->current->get() === self::FIRST;
    }

    /** @inheritDoc */
    public function isLast(): bool
    {
        return $this->current->get() === $this->last;
    }

    /** @inheritDoc */
    public function getPrev(): int
    {
        return ($this->current->get() > self::FIRST)
            ? $this->current->get() - 1
            : self::FIRST;
    }

    /** @inheritDoc */
    public function getNext(): int
    {
        return ($this->current->get() < $this->last)
            ? $this->current->get() + 1
            : $this->last;
    }

    /** @inheritDoc */
    public function getLast(): int {
        return $this->last;
    }

    /** @inheritDoc */
    public function getIterator(): Generator
    {
        $pages = $this->range->getPages(
            $this->current,
            $this->display,
            $this->total
        );

        foreach ($pages as $page) {
            yield $page;
        }
    }

    /** @inheritDoc */
    public function jsonSerialize(): array
    {
        return (array)$this;
    }
}
