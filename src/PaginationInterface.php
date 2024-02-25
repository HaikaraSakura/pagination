<?php

declare(strict_types=1);

namespace Haikara\Pagination;

use IteratorAggregate;
use JsonSerializable;
use Traversable;

interface PaginationInterface extends JsonSerializable, IteratorAggregate
{
    public const FIRST = 1;

    /**
     * 表示する範囲のページ番号をすべて取得
     *
     * @return int[]
     */
    public function getPages(): array;

    /**
     * 現在のページ番号を取得する。
     * @return int
     */
    public function getCurrent(): int;

    /**
     * 最後のページ数を取得する。
     * @return int
     */
    public function getLast(): int;

    /**
     * 現在のページと等しいページ番号か
     * @param int $number
     * @return bool
     */
    public function isCurrent(int $number): bool;
    
    /**
     * 現在のページが1ページ目か
     * @return bool
     */
    public function isFirst(): bool;

    /**
     * 現在のページが最後のページか。
     * @return bool
     */
    public function isLast(): bool;

    /**
     * 前のページ番号を取得。現在が1ページ目なら1を返す。
     * @return int
     */
    public function getPrev(): int;

    /**
     * 次のページ番号を取得。現在が最後のページなら最後のページ番号を返す。
     *
     * @return int
     */
    public function getNext(): int;

    /**
     * @return int 総件数を取得
     */
    public function getTotal(): int;

    /**
     * @return int 表示する最初のページ番号を取得
     */
    public function getDisplayFirst(): int;


    /**
     * @return int 表示する最後のページ番号を取得
     */
    public function getDisplayLast(): int;

    /**
     * @return int 表示するデータの最大件数を取得
     */
    public function getLimit(): int;

    /**
     * @return Traversable<int>
     */
    public function getIterator(): Traversable;
}
