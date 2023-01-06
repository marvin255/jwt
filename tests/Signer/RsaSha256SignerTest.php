<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Exception\SecretKeyIsInvalid;
use Marvin255\Jwt\Signer\RsaSha256Signer;
use Marvin255\Jwt\Signer\Secret;
use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\JoseHeaderParams;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
class RsaSha256SignerTest extends BaseCase
{
    public function testUpdateJoseParams(): void
    {
        $jose = ['test' => 'test value'];
        $awaitedJose = ['test' => 'test value', JoseHeaderParams::ALG->value => 'RS256'];

        $public = $this->getPublicKey();
        $private = $this->getPrivateKey();

        $signer = new RsaSha256Signer($public, $private);
        $updatedJose = $signer->updateJoseParams($jose);

        $this->assertSame($awaitedJose, $updatedJose);
    }

    public function testCreateSignature(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $awaitedSignature = file_get_contents(__DIR__ . '/_fixtures/RsaSha256SignerTest_signature.txt');

        $public = $this->getPublicKey();
        $private = $this->getPrivateKey();

        $signer = new RsaSha256Signer($public, $private);
        $signature = $signer->createSignature($jose, $claims);

        $this->assertSame($awaitedSignature, $signature);
    }

    public function testCreateSignatureWrongKeyException(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $awaitedSignature = file_get_contents(__DIR__ . '/_fixtures/RsaSha256SignerTest_signature.txt');

        $public = $this->getPublicKey();
        $private = $this->getPrivateKey();

        $signer = new RsaSha256Signer($private, $public);

        $this->expectException(SecretKeyIsInvalid::class);
        $signer->createSignature($jose, $claims);
    }

    public function testVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = file_get_contents(__DIR__ . '/_fixtures/RsaSha256SignerTest_signature.txt');
        $token = $this->getTokenMock($jose, $claims, $signature);

        $public = $this->getPublicKey();
        $private = $this->getPrivateKey();

        $signer = new RsaSha256Signer($public, $private);
        $isVerified = $signer->verifyToken($token);

        $this->assertTrue($isVerified);
    }

    public function testDoesNotVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = '123';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $public = $this->getPublicKey();
        $private = $this->getPrivateKey();

        $signer = new RsaSha256Signer($public, $private);
        $isVerified = $signer->verifyToken($token);

        $this->assertFalse($isVerified);
    }

    public function testVerifyTokenWrongKeyException(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = '123';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $public = $this->getPublicKey();
        $private = $this->getPrivateKey();

        $signer = new RsaSha256Signer($private, $public);

        $this->expectException(SecretKeyIsInvalid::class);
        $signer->verifyToken($token);
    }

    private function getPublicKey(): Secret
    {
        /** @var MockObject&Secret */
        $public = $this->getMockBuilder(Secret::class)->getMock();
        $public->method('getSecret')->willReturn(
            file_get_contents(__DIR__ . '/_fixtures/RsaSha256SignerTest_public.key')
        );

        return $public;
    }

    private function getPrivateKey(): Secret
    {
        /** @var MockObject&Secret */
        $private = $this->getMockBuilder(Secret::class)->getMock();
        $private->method('getSecret')->willReturn(
            file_get_contents(__DIR__ . '/_fixtures/RsaSha256SignerTest_private.key')
        );

        return $private;
    }
}
