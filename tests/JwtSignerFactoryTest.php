<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test;

use Marvin255\Jwt\Exception\SignerAlgorithmNotFoundException;
use Marvin255\Jwt\JwtSignerFactory;
use Marvin255\Jwt\Signer\Algorithm;
use Marvin255\Jwt\Signer\Rsa;
use Marvin255\Jwt\Signer\Secret;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
class JwtSignerFactoryTest extends BaseCase
{
    public function testCreateRsa(): void
    {
        $algorithm = Algorithm::RSA_SHA_512;
        /** @var Secret&MockObject */
        $public = $this->getMockBuilder(Secret::class)->getMock();
        /** @var Secret&MockObject */
        $private = $this->getMockBuilder(Secret::class)->getMock();

        $res = JwtSignerFactory::createRsa($algorithm, $public, $private);

        $this->assertInstanceOf(Rsa::class, $res);
    }

    public function testCreateRsaWrongAlgorithmException(): void
    {
        $exception = new SignerAlgorithmNotFoundException('Wrong algorithm provided');

        $this->expectExceptionObject($exception);
        JwtSignerFactory::createRsa(Algorithm::HMAC_SHA_256);
    }
}
