<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Encoder;

use Marvin255\Jwt\Encoder\Encoder;
use Marvin255\Jwt\Test\BaseCase;

/**
 * @internal
 */
final class EncoderTest extends BaseCase
{
    public function testEncode(): void
    {
        $token = $this->getTokenMock(
            [
                'alg' => 'HS256',
                'typ' => 'JWT',
            ],
            [
                'sub' => '1234567890',
                'name' => 'John Doe',
                'iat' => 1516239022,
            ],
            'SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c'
        );
        $tokenString = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9'
            . '.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ'
            . '.U2ZsS3h3UkpTTWVLS0YyUVQ0ZndwTWVKZjM2UE9rNnlKVl9hZFFzc3c1Yw';

        $encoder = new Encoder();
        $encodedToken = $encoder->encode($token);

        $this->assertSame($tokenString, $encodedToken);
    }
}
