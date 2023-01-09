<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Signer\HmacSha256Signer;
use Marvin255\Jwt\Signer\Secret;
use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\JoseHeaderParams;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
class HmacSha256SignerTest extends BaseCase
{
    public function testUpdateJoseParams(): void
    {
        $jose = ['test' => 'test value'];
        $awaitedJose = ['test' => 'test value', JoseHeaderParams::ALG->value => 'HS256'];

        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();

        $signer = new HmacSha256Signer($secret);
        $updatedJose = $signer->updateJoseParams($jose);

        $this->assertSame($awaitedJose, $updatedJose);
    }

    public function testCreateSignature(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $awaitedSignature = '6318e5220a6413bcb3a1700edcf5ea095792515687920aaad762e1ac2ea241a2';

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha256Signer($secret);
        $signature = $signer->createSignature($jose, $claims);

        $this->assertSame($awaitedSignature, $signature);
    }

    public function testVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = '6318e5220a6413bcb3a1700edcf5ea095792515687920aaad762e1ac2ea241a2';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha256Signer($secret);
        $isVerified = $signer->verifyToken($token);

        $this->assertTrue($isVerified);
    }

    public function testDoesNotVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = '6318e5220a6413bcb3a1700edcf5ea095792515687920aaad76_e1ac2ea241a2';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha256Signer($secret);
        $isVerified = $signer->verifyToken($token);

        $this->assertFalse($isVerified);
    }
}
