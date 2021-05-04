<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Signer\NoneSigner;
use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\JoseHeader;

/**
 * @internal
 */
class NoneSignerTest extends BaseCase
{
    public function testUpdateJoseParams(): void
    {
        $jose = ['test' => 'test value'];
        $awaitedJose = ['test' => 'test value', JoseHeader::ALG => 'none'];

        $signer = new NoneSigner();
        $updatedJose = $signer->updateJoseParams($jose);

        $this->assertSame($awaitedJose, $updatedJose);
    }

    public function testCreateSignature(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $awaitedSignature = '';

        $signer = new NoneSigner();
        $signature = $signer->createSignature($jose, $claims);

        $this->assertSame($awaitedSignature, $signature);
    }

    public function testVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = '';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $signer = new NoneSigner();
        $isVerified = $signer->verifyToken($token);

        $this->assertTrue($isVerified);
    }

    public function testDoesNotVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = 'test';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $signer = new NoneSigner();
        $isVerified = $signer->verifyToken($token);

        $this->assertFalse($isVerified);
    }
}
