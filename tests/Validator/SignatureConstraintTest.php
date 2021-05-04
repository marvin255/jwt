<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Validator;

use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Validator\SignatureConstraint;

/**
 * @internal
 */
class SignatureConstraintTest extends BaseCase
{
    public function testCheckToken(): void
    {
        $token = $this->getTokenMock();

        $signer = $this->getMockBuilder(JwtSigner::class)->getMock();
        $signer->method('verifyToken')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn(true);

        $constraint = new SignatureConstraint($signer);
        $isChecked = $constraint->checkToken($token);

        $this->assertTrue($isChecked);
    }

    public function testDoesNotCheckToken(): void
    {
        $token = $this->getTokenMock();

        $signer = $this->getMockBuilder(JwtSigner::class)->getMock();
        $signer->method('verifyToken')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn(false);

        $constraint = new SignatureConstraint($signer);
        $isChecked = $constraint->checkToken($token);

        $this->assertFalse($isChecked);
    }

    public function testCreateErrorMessage(): void
    {
        $token = $this->getTokenMock();
        $signer = $this->getMockBuilder(JwtSigner::class)->getMock();

        $constraint = new SignatureConstraint($signer);
        $error = $constraint->createErrorMessage($token);

        $this->assertNotEmpty($error);
    }
}
