<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Signer\HmacSha512Signer;
use Marvin255\Jwt\Signer\Secret;
use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\JoseHeaderParams;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
final class HmacSha512SignerTest extends BaseCase
{
    public function testUpdateJoseParams(): void
    {
        $jose = ['test' => 'test value'];
        $awaitedJose = ['test' => 'test value', JoseHeaderParams::ALG->value => 'HS512'];

        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();

        $signer = new HmacSha512Signer($secret);
        $updatedJose = $signer->updateJoseParams($jose);

        $this->assertSame($awaitedJose, $updatedJose);
    }

    public function testCreateSignature(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $awaitedSignature = '9ee8a478932156c15d52b4541dddefce7bfd9d78d8a0894b4a3094b312fcb4b09cf5b591ce4f38269deded02344a97cad4ba37d078672b81cef9c61e905af091';

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha512Signer($secret);
        $signature = $signer->createSignature($jose, $claims);

        $this->assertSame($awaitedSignature, $signature);
    }

    public function testVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = '9ee8a478932156c15d52b4541dddefce7bfd9d78d8a0894b4a3094b312fcb4b09cf5b591ce4f38269deded02344a97cad4ba37d078672b81cef9c61e905af091';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha512Signer($secret);
        $isVerified = $signer->verifyToken($token);

        $this->assertTrue($isVerified);
    }

    public function testDoesNotVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = '9ee8a478932156c15d52b4541dddefce7bfd9d78d8a0894b4a3094b312fcb4b09cf5b591ce4f38269deded02344a97cad4ba37_078672b81cef9c61e905af091';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha512Signer($secret);
        $isVerified = $signer->verifyToken($token);

        $this->assertFalse($isVerified);
    }
}
