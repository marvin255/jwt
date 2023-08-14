<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test;

use Marvin255\Jwt\Exception\SignerAlgorithmNotFoundException;
use Marvin255\Jwt\JwtSignerFactory;
use Marvin255\Jwt\Signer\Algorithm;
use Marvin255\Jwt\Signer\Hmac;
use Marvin255\Jwt\Signer\NoneSigner;
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
        $public = $this->createSecretMock();
        $private = $this->createSecretMock();

        $res = JwtSignerFactory::createRsa($algorithm, $public, $private);

        $this->assertInstanceOf(Rsa::class, $res);
    }

    public function testCreateRsaWrongAlgorithmException(): void
    {
        $exception = new SignerAlgorithmNotFoundException('Wrong algorithm provided');

        $this->expectExceptionObject($exception);
        JwtSignerFactory::createRsa(Algorithm::HMAC_SHA_256);
    }

    public function testCreateHmac(): void
    {
        $algorithm = Algorithm::HMAC_SHA_256;
        $secret = $this->createSecretMock();

        $res = JwtSignerFactory::createHmac($algorithm, $secret);

        $this->assertInstanceOf(Hmac::class, $res);
    }

    public function testCreateHmacWrongAlgorithmException(): void
    {
        $secret = $this->createSecretMock();
        $exception = new SignerAlgorithmNotFoundException('Wrong algorithm provided');

        $this->expectExceptionObject($exception);
        JwtSignerFactory::createHmac(Algorithm::RSA_SHA_256, $secret);
    }

    public function testCreateNone(): void
    {
        $res = JwtSignerFactory::createNone();

        $this->assertInstanceOf(NoneSigner::class, $res);
    }

    /**
     * @return Secret&MockObject
     */
    private function createSecretMock(): Secret
    {
        /** @var Secret&MockObject */
        $secret = $this->getMockBuilder(Secret::class)->getMock();

        return $secret;
    }
}
