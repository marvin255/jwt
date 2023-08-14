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
    public function testNegativeLeewayException(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new NotBeforeConstraint(-1);
    }

    /**
     * @dataProvider checkTokenProvider
     */
    public function testCheckToken(?int $timeAdd, int $leeway, bool $expected): void
    {
        $jose = [];
        $claims = [];

        if ($timeAdd !== null) {
            $claims[ClaimSetParams::NBF->value] = time() + $timeAdd;
        }

        $token = $this->getTokenMock($jose, $claims);

        $constraint = new NotBeforeConstraint($leeway);
        $isChecked = $constraint->checkToken($token);

        $this->assertSame($expected, $isChecked);
    }

    public static function checkTokenProvider(): array
    {
        return [
            'positive test without leeway' => [-5, 0, true],
            'positive test with leeway' => [5, 7, true],
            'negative test without leeway' => [5, 0, false],
            'negative test with leeway' => [5, 3, false],
            'without nbf header' => [null, 3, true],
            'zero leeway' => [0, 0, true],
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
