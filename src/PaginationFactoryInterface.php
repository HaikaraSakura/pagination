<?php

declare(strict_types=1);

namespace Haikara\Pagination;

interface PaginationFactoryInterface
{
    /**
     * @param int $range ページネーションとして表示するページ番号の数
     * @param int $display 一覧に表示する数。limit値。
     * @param int $current ユーザが指定した現在のページ番号
     * @param int $total 検索に一致した全件数
     */
    public static function create(
        int $range,
        int $display,
        int $current,
        int $total
    ): PaginationInterface;
}