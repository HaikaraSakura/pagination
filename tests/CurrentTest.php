<?php

declare(strict_types=1);

use Haikara\Pagination\Current;
use Haikara\Pagination\Exceptions\CurrentException;
use PHPUnit\Framework\TestCase;

class CurrentTest extends TestCase
{
    /**
     * インスタンス化の正常系
     *
     * @return void
     */
    public function testConstruct(): void
    {
        $current = new Current(1);
        self::assertInstanceOf(Current::class, $current);
        self::assertSame(1, $current->get());
    }

    /**
     * インスタンス化の異常系
     *
     * @return void
     */
    public function testConstructFail(): void
    {
        $this->expectException(CurrentException::class);
        new Current(0);
    }

    /**
     * 文字列呼び出しの正常系
     *
     * @return void
     */
    public function testToString(): void
    {
        self::assertSame('1', (string)new Current(1));
    }

    /**
     * JsonSerialize時の正常系
     *
     * @return void
     */
    public function testJsonSerialize(): void
    {
        $current = new Current(1);
        self::assertSame(1, $current->jsonSerialize());
    }

    /**
     * createWithinRangeの、currentがlastより小さい範囲内の場合
     *
     * @dataProvider withinRangeProvider
     * @param int $current
     * @param int $last
     * @param int $result
     * @return void
     */
    public function testCreateWithinRange(int $current, int $last, int $result): void
    {
        $current = Current::createWithinRange($current, $last);
        self::assertSame($current->get(), $result);
    }

    public function withinRangeProvider(): array
    {
        return [
            ['current' => 3, 'last' => 5, 'result' => 3],
            ['current' => 8, 'last' => 5, 'result' => 5]
        ];
    }
}
