<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Signer\HmacSha384Signer;
use Marvin255\Jwt\Signer\Secret;
use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\JoseHeaderParams;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
class HmacSha384SignerTest extends BaseCase
{
    public function testUpdateJoseParams(): void
    {
        $jose = ['test' => 'test value'];
        $awaitedJose = ['test' => 'test value', JoseHeaderParams::ALG->value => 'HS384'];

        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();

        $signer = new HmacSha384Signer($secret);
        $updatedJose = $signer->updateJoseParams($jose);

        $this->assertSame($awaitedJose, $updatedJose);
    }

    public function testCreateSignature(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $awaitedSignature = 'b8b6fb84d68ae0915bd3b7bf55525b222e5071020e175aee5fc4a950c9b37c55d484a6be5e12d661389e31a72d1a1c58';

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha384Signer($secret);
        $signature = $signer->createSignature($jose, $claims);

        $this->assertSame($awaitedSignature, $signature);
    }

    public function testVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = 'b8b6fb84d68ae0915bd3b7bf55525b222e5071020e175aee5fc4a950c9b37c55d484a6be5e12d661389e31a72d1a1c58';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha384Signer($secret);
        $isVerified = $signer->verifyToken($token);

        $this->assertTrue($isVerified);
    }

    public function testDoesNotVerifyToken(): void
    {
        $jose = ['test_jose' => 'test jose value'];
        $claims = ['test_claim' => 'test claim value'];
        $signature = 'b8b6fb84d68ae0915bd3b7bf55525b222e5071020e175aee5fc4a950c9b37c55d484a6be5e12d661389e31_72d1a1c58';
        $token = $this->getTokenMock($jose, $claims, $signature);

        $secretString = 'test secret';
        /** @var MockObject&Secret */
        $secret = $this->getMockBuilder(Secret::class)->getMock();
        $secret->method('getSecret')->willReturn($secretString);

        $signer = new HmacSha384Signer($secret);
        $isVerified = $signer->verifyToken($token);

        $this->assertFalse($isVerified);
    }
}
