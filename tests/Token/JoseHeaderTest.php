<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Token;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\JoseHeader;

/**
 * @internal
 */
class JoseHeaderTest extends BaseCase
{
    public function testHas(): void
    {
        $param = 'param';
        $paramValue = 'param_value';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);

        $this->assertTrue($jose->has($param));
    }

    public function testHasNull(): void
    {
        $param = 'param';
        $paramValue = null;
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);

        $this->assertTrue($jose->has($param));
    }

    public function testDoesntHave(): void
    {
        $param = 'param';
        $paramValue = 'param_value';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);

        $this->assertFalse($jose->has('unexisted'));
    }

    public function testGetParam(): void
    {
        $param = 'param';
        $paramValue = 'param_value';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->get($param);

        $this->assertSame($paramValue, $gotParam);
    }

    public function testToArray(): void
    {
        $param = 'param';
        $paramValue = 'param_value';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $array = $jose->toArray();

        $this->assertSame($paramSet, $array);
    }

    public function testGetTyp(): void
    {
        $param = JoseHeader::TYP;
        $paramValue = 'JWT';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getTyp();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetTypNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getTyp();

        $this->assertNull($gotParam);
    }

    public function testGetCty(): void
    {
        $param = JoseHeader::CTY;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getCty();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetCtyNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getCty();

        $this->assertNull($gotParam);
    }

    public function testGetAlg(): void
    {
        $param = JoseHeader::ALG;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getAlg();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetAlgNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getAlg();

        $this->assertNull($gotParam);
    }

    public function testGetJku(): void
    {
        $param = JoseHeader::JKU;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getJku();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetJkuNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getJku();

        $this->assertNull($gotParam);
    }

    public function testGetJwk(): void
    {
        $param = JoseHeader::JWK;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getJwk();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetJwkNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getJwk();

        $this->assertNull($gotParam);
    }

    public function testGetKid(): void
    {
        $param = JoseHeader::KID;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getKid();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetKidNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getKid();

        $this->assertNull($gotParam);
    }

    public function testGetX5u(): void
    {
        $param = JoseHeader::X5U;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5u();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetX5uNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5u();

        $this->assertNull($gotParam);
    }

    public function testGetX5c(): void
    {
        $param = JoseHeader::X5C;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5c();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetX5cNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5c();

        $this->assertNull($gotParam);
    }

    public function testGetX5t(): void
    {
        $param = JoseHeader::X5T;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5t();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetX5tNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5t();

        $this->assertNull($gotParam);
    }

    public function testGetX5t256(): void
    {
        $param = JoseHeader::X5T256;
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5t256();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetX5t256Null(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getX5t256();

        $this->assertNull($gotParam);
    }

    public function testGetCrit(): void
    {
        $param = JoseHeader::CRIT;
        $paramValue = ['test'];
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getCrit();

        $this->assertSame($paramValue, $gotParam);
    }

    public function testGetCritNull(): void
    {
        $param = 'test';
        $paramValue = 'test';
        $paramSet = [$param => $paramValue];

        $jose = new JoseHeader($paramSet);
        $gotParam = $jose->getCrit();

        $this->assertNull($gotParam);
    }
}
