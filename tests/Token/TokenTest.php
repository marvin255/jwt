<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Token;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\Token;

/**
 * @internal
 */
class TokenTest extends BaseCase
{
    public function testJose(): void
    {
        $jose = $this->getJoseHeaderMock();
        $claims = $this->getClaimSetMock();
        $signature = $this->getSignatureMock();

        $token = new Token($jose, $claims, $signature);

        $this->assertSame($jose, $token->jose());
    }

    public function testClaims(): void
    {
        $jose = $this->getJoseHeaderMock();
        $claims = $this->getClaimSetMock();
        $signature = $this->getSignatureMock();

        $token = new Token($jose, $claims, $signature);

        $this->assertSame($claims, $token->claims());
    }

    public function testSignature(): void
    {
        $jose = $this->getJoseHeaderMock();
        $claims = $this->getClaimSetMock();
        $signature = $this->getSignatureMock();

        $token = new Token($jose, $claims, $signature);

        $this->assertSame($signature, $token->signature());
    }
}
