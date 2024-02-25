<?php

declare(strict_types=1);

use Haikara\Pagination\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    /**
     * インスタンス化の正常系
     *
     * @dataProvider constructProvider
     * @param int $current
     * @return void
     */
    public function testConstruct(int $current): void
    {
        $pagination = new Pagination(5, 10, $current, 100);
        self::assertInstanceOf(Pagination::class, $pagination);
    }

    public function constructProvider(): array
    {
        return [
            ['current' => 4],
            ['current' => 11]
        ];
    }

    /**
     * getPagesで取得できる、表示するページ番号の配列を検証する
     *
     * @dataProvider getPagesProvider
     * @param int $current
     * @param int $total
     * @param array $pages
     * @return void
     */
    public function testGetPages(int $current, int $total, array $pages): void
    {
        $pagination = new Pagination(5, 10, $current, $total);
        self::assertSame($pagination->getPages(), $pages);
    }

    public function getPagesProvider(): array
    {
        return [
            ['current' => 1, 'total' => 50, 'pages' => [1, 2, 3, 4, 5]],
            ['current' => 2, 'total' => 50, 'pages' => [1, 2, 3, 4, 5]],
            ['current' => 3, 'total' => 50, 'pages' => [1, 2, 3, 4, 5]],
            ['current' => 9, 'total' => 100, 'pages' => [6, 7, 8, 9, 10]],
            ['current' => 10, 'total' => 100, 'pages' => [6, 7, 8, 9, 10]],
            ['current' => 3, 'total' => 40, 'pages' => [1, 2, 3, 4]],
            ['current' => 3, 'total' => 30, 'pages' => [1, 2, 3]],
            ['current' => 2, 'total' => 30, 'pages' => [1, 2, 3]],
            ['current' => 1, 'total' => 1, 'pages' => [1]],
            ['current' => 1, 'total' => 0, 'pages' => []],
        ];
    }

    /**
     * インスタンス化の正常系
     *
     * @dataProvider getLastProvider
     * @param int $total
     * @param int $last
     * @return void
     */
    public function testGetLast(int $total, int $last): void
    {
        $pagination = new Pagination(5, 10, 3, $total);
        self::assertSame($pagination->getLast(), $last);
    }

    public function getLastProvider(): array
    {
        return [
            ['total' => 50, 'last' => 5],
            ['total' => 20, 'last' => 2],
            ['total' => 10, 'last' => 1],
            ['total' => 9, 'last' => 1],
            ['total' => 0, 'last' => 1],
        ];
    }

    /**
     * インスタンス化の正常系
     *
     * @dataProvider isFirstProvider
     * @param int $current
     * @param int $total
     * @param bool $bool
     * @return void
     */
    public function testIsFirst(int $current, int $total, bool $bool): void
    {
        $pagination = new Pagination(5, 10, $current, $total);
        self::assertSame($pagination->isFirst(), $bool);
    }

    public function isFirstProvider(): array
    {
        return [
            ['current' => 1, 'total' => 50, 'bool' => true],
            ['current' => 1, 'total' => 20, 'bool' => true],
            ['current' => 3, 'total' => 10, 'bool' => true],
            ['current' => 5, 'total' => 100, 'bool' => false]
        ];
    }

    /**
     * インスタンス化の正常系
     *
     * @dataProvider isLastProvider
     * @param int $current
     * @param int $total
     * @param bool $bool
     * @return void
     */
    public function testIsLast(int $current, int $total, bool $bool): void
    {
        $pagination = new Pagination(5, 10, $current, $total);
        self::assertSame($pagination->isLast(), $bool);
    }

    public function isLastProvider(): array
    {
        return [
            ['current' => 5, 'total' => 50, 'bool' => true],
            ['current' => 2, 'total' => 20, 'bool' => true],
            ['current' => 3, 'total' => 10, 'bool' => true],
            ['current' => 5, 'total' => 100, 'bool' => false]
        ];
    }

    /**
     * インスタンス化の正常系
     *
     * @dataProvider getPrevProvider
     * @param int $current
     * @param int $total
     * @param int $prev
     * @return void
     */
    public function testGetPrev(int  $current, int $total, int $prev): void
    {
        $pagination = new Pagination(5, 10, $current, $total);
        self::assertSame($pagination->getPrev(), $prev);
    }

    public function getPrevProvider(): array
    {
        return [
            ['current' => 5, 'total' => 50, 'prev' => 4],
            ['current' => 2, 'total' => 20, 'prev' => 1],
            ['current' => 3, 'total' => 10, 'prev' => 1],
            ['current' => 5, 'total' => 100, 'prev' => 4]
        ];
    }

    /**
     * インスタンス化の正常系
     *
     * @dataProvider getNextProvider
     * @param int $current
     * @param int $total
     * @param int $next
     * @return void
     */
    public function testGetNext(int $current, int $total, int $next): void
    {
        $pagination = new Pagination(5, 10, $current, $total);
        self::assertSame($pagination->getNext(), $next);
    }

    public function getNextProvider(): array
    {
        return [
            ['current' => 5, 'total' => 50, 'next' => 5],
            ['current' => 2, 'total' => 20, 'next' => 2],
            ['current' => 3, 'total' => 10, 'next' => 1],
            ['current' => 5, 'total' => 100, 'next' => 6]
        ];
    }

    // TODO jsonSerializeのテスト未実装
}
