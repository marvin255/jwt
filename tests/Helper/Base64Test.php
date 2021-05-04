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
    public function testUrlEncode(): void
    {
        $data = 'test data';
        $awaitedData = 'dGVzdCBkYXRh';

        $encodedData = Base64::urlEncode($data);

        $this->assertSame($awaitedData, $encodedData);
    }

    public function testUrlDecode(): void
    {
        $data = 'dGVzdCBkYXRh';
        $awaitedData = 'test data';

        $encodedData = Base64::urlDecode($data);

        $this->assertSame($awaitedData, $encodedData);
    }

    public function testArrayEncode(): void
    {
        $data = ['test' => 'test value', 'test_2' => 'test value 2'];
        $awaitedData = 'eyJ0ZXN0IjoidGVzdCB2YWx1ZSIsInRlc3RfMiI6InRlc3QgdmFsdWUgMiJ9';

        $encodedData = Base64::arrayEncode($data);

        $this->assertSame($awaitedData, $encodedData);
    }

    public function testArrayDencode(): void
    {
        $data = 'eyJ0ZXN0IjoidGVzdCB2YWx1ZSIsInRlc3RfMiI6InRlc3QgdmFsdWUgMiJ9';
        $awaitedData = ['test' => 'test value', 'test_2' => 'test value 2'];

        $encodedData = Base64::arrayDecode($data);

        $this->assertSame($awaitedData, $encodedData);
    }
}
