<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Validator;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\ClaimSetParams;
use Marvin255\Jwt\Validator\ExpirationConstraint;

/**
 * @internal
 */
class ExpirationConstraintTest extends BaseCase
{
    public function testNegativeLeewayException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new ExpirationConstraint(-1);
    }

    /**
     * @dataProvider checkTokenProvider
     */
    public function testCheckToken(?int $timeAdd, int $leeway, bool $expected): void
    {
        $jose = [];
        $claims = [];

        if ($timeAdd !== null) {
            $claims[ClaimSetParams::EXP->value] = time() + $timeAdd;
        }

        $token = $this->getTokenMock($jose, $claims);

        $constraint = new ExpirationConstraint($leeway);
        $isChecked = $constraint->checkToken($token);

        $this->assertSame($expected, $isChecked);
    }

    public function checkTokenProvider(): array
    {
        return [
            'positive test without leeway' => [5, 0, true],
            'positive test with leeway' => [-4, 5, true],
            'negative test without leeway' => [-5, 0, false],
            'negative test with leeway' => [-5, 4, false],
            'without exp header' => [null, 4, true],
            'zero leeway' => [0, 0, true],
        ];
    }

    public function testCreateErrorMessage(): void
    {
        $token = $this->getTokenMock();

        $constraint = new ExpirationConstraint();
        $error = $constraint->createErrorMessage($token);

        $this->assertNotEmpty($error);
    }
}
