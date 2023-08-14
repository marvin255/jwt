<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Validator;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\ClaimSetParams;
use Marvin255\Jwt\Validator\AudienceConstraint;

/**
 * @internal
 */
class AudienceConstraintTest extends BaseCase
{
    /**
     * @dataProvider checkTokenProvider
     */
    public function testCheckToken(mixed $tokenAudience, string $awaitedAudience, bool $expected, string $message): void
    {
        $jose = [];
        $claims = [];

        if ($tokenAudience !== null) {
            $claims[ClaimSetParams::AUD->value] = $tokenAudience;
        }

        $token = $this->getTokenMock($jose, $claims);

        $constraint = new AudienceConstraint($awaitedAudience);
        $isChecked = $constraint->checkToken($token);

        $this->assertSame($expected, $isChecked, $message);
    }

    public static function checkTokenProvider(): array
    {
        return [
            [['qwe', 'asd', 'zxc'], 'asd', true, 'Positive test with array.'],
            ['asd', 'asd', true, 'Positive test with string.'],
            [['qwe', 'asd', 'zxc'], 'poi', false, 'Negative test with array.'],
            ['qwe', 'asd', false, 'Negative test with string.'],
            [null, 'asd', false, 'Without aud header.'],
        ];
    }

    public function testCreateErrorMessage(): void
    {
        $token = $this->getTokenMock();

        $constraint = new AudienceConstraint('test');
        $error = $constraint->createErrorMessage($token);

        $this->assertNotEmpty($error);
    }
}
