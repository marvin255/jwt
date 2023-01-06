<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Validator;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\ClaimSetParams;
use Marvin255\Jwt\Validator\NotBeforeConstraint;

/**
 * @internal
 */
class NotBeforeConstraintTest extends BaseCase
{
    /**
     * @dataProvider checkTokenProvider
     */
    public function testCheckToken(?int $timeAdd, int $leeway, bool $expected, string $message): void
    {
        $jose = [];
        $claims = [];

        if ($timeAdd !== null) {
            $claims[ClaimSetParams::NBF->value] = time() + $timeAdd;
        }

        $token = $this->getTokenMock($jose, $claims);

        $constraint = new NotBeforeConstraint($leeway);
        $isChecked = $constraint->checkToken($token);

        $this->assertSame($expected, $isChecked, $message);
    }

    public function checkTokenProvider(): array
    {
        return [
            [-5, 0, true, 'Positive test without leeway.'],
            [5, 7, true, 'Positive test with leeway.'],
            [5, 0, false, 'Negative test without leeway.'],
            [5, 3, false, 'Negative test with leeway.'],
            [null, 3, true, 'Without nbf header.'],
        ];
    }

    public function testCreateErrorMessage(): void
    {
        $token = $this->getTokenMock();

        $constraint = new NotBeforeConstraint();
        $error = $constraint->createErrorMessage($token);

        $this->assertNotEmpty($error);
    }
}
