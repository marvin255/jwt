<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Helper;

use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Test\BaseCase;

/**
 * @internal
 */
class Base64Test extends BaseCase
{
    /**
     * @dataProvider provideUrlEncodeDecode
     */
    public function testUrlEncode(string $result, string $data): void
    {
        $this->assertSame($result, Base64::urlEncode($data));
    }

    /**
     * @dataProvider provideUrlEncodeDecode
     */
    public function testUrlDecode(string $data, string $result): void
    {
        $this->assertSame($result, Base64::urlDecode($data));
    }

    public static function provideUrlEncodeDecode(): array
    {
        return [
            'simple case' => [
                'dGVzdCBkYXRh',
                'test data',
            ],
            'empty string' => [
                '',
                '',
            ],
            'string with new line' => [
                'Tm93IGlzIHRoZSB0aW1lIGZvciBhbGwgZ29vZCBjb2RlcnMKdG8gbGVhcm4gcGhw',
                "Now is the time for all good coders\nto learn php",
            ],
            'underscore symbol' => [
                '_____w',
                "\xff\xff\xff\xff",
            ],
            'minus symbol' => [
                '-w',
                "\xfb",
            ],
        ];
    }

    /**
     * @dataProvider provideArrayEncodeDecode
     */
    public function testArrayEncode(string $result, array $data): void
    {
        $this->assertSame($result, Base64::arrayEncode($data));
    }

    /**
     * @dataProvider provideArrayEncodeDecode
     */
    public function testArrayDecode(string $data, array $result): void
    {
        $this->assertSame($result, Base64::arrayDecode($data));
    }

    public static function provideArrayEncodeDecode(): array
    {
        return [
            'simple array' => [
                'eyJ0ZXN0IjoidGVzdCB2YWx1ZSIsInRlc3RfMiI6InRlc3QgdmFsdWUgMiJ9',
                ['test' => 'test value', 'test_2' => 'test value 2'],
            ],
            'array with utf' => [
                'eyLQv9Cw0YDQsNC80LXRgtGAMSI6ItC30L3QsNGH0LXQvdC40LUxIiwi0L_QsNGA0LDQvNC10YLRgDIiOiLQt9C90LDRh9C10L3QuNC1MiJ9',
                ['параметр1' => 'значение1', 'параметр2' => 'значение2'],
            ],
            'array with slashes' => [
                'eyIvIjoiLyIsIlxcIjoiXFwifQ',
                ['/' => '/', '\\' => '\\'],
            ],
        ];
    }
}
