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
    /**
     * @dataProvider checkTokenProvider
     */
    public function testCheckToken(?int $timeAdd, int $leeway, bool $expected, string $message): void
    {
        $jose = [];
        $claims = [];

        if ($timeAdd !== null) {
            $claims[ClaimSetParams::EXP->value] = time() + $timeAdd;
        }

        $token = $this->getTokenMock($jose, $claims);

        $constraint = new ExpirationConstraint($leeway);
        $isChecked = $constraint->checkToken($token);

        $this->assertSame($expected, $isChecked, $message);
    }

    public function checkTokenProvider(): array
    {
        return [
            [5, 0, true, 'Positive test without leeway.'],
            [-4, 5, true, 'Positive test with leeway.'],
            [-5, 0, false, 'Negative test without leeway.'],
            [-5, 4, false, 'Negative test with leeway.'],
            [null, 4, true, 'Without exp header.'],
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
