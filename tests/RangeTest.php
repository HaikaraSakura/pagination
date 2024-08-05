<?php

declare(strict_types=1);

use Haikara\Pagination\Exceptions\RangeException;
use Haikara\Pagination\Range;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class RangeTest extends TestCase
{
    /**
     * インスタンス化の正常系
     *
     * @param int $range_num
     * @return void
     */
    #[DataProvider('constructProvider')]
    public function testコンストラクタ正常系(int$range_num): void
    {
        $range = new Range($range_num);
        self::assertInstanceOf(Range::class, $range);
        self::assertSame($range->get(), $range_num);
    }

    public static function constructProvider(): array
    {
        return [
            [3], [5], [11]
        ];
    }

    /**
     * インスタンス化の異常系
     *
     * @return void
     */
    #[DataProvider('constructFailProvider')]
    public function testコンストラクタ異常系($range_num)
    {
        $this->expectException(RangeException::class);
        new Range($range_num);
    }

    public static function constructFailProvider(): array
    {
        return [
            [-1], [0]
        ];
    }
}
