<?php

declare(strict_types=1);

use Haikara\Pagination\Exceptions\RangeException;
use Haikara\Pagination\Range;
use PHPUnit\Framework\TestCase;

class RangeTest extends TestCase
{
    /**
     * インスタンス化の正常系
     *
     * @dataProvider constructProvider
     * @return void
     */
    public function testコンストラクタ正常系($range_num)
    {
        $range = new Range($range_num);
        self::assertInstanceOf(Range::class, $range);
        self::assertSame($range->get(), $range_num);
    }

    public function constructProvider(): array
    {
        return [
            [3], [5], [11]
        ];
    }

    /**
     * インスタンス化の異常系
     *
     * @dataProvider constructFailProvider
     * @return void
     */
    public function testコンストラクタ異常系($range_num)
    {
        $this->expectException(RangeException::class);
        new Range($range_num);
    }

    public function constructFailProvider(): array
    {
        return [
            [-1], [0]
        ];
    }
}
