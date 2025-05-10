<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Decoder;

use Marvin255\Jwt\Decoder\Decoder;
use Marvin255\Jwt\Exception\JwtException;
use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtBuilder;
use Marvin255\Jwt\Test\BaseCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
final class DecoderTest extends BaseCase
{
    #[\PHPUnit\Framework\Attributes\DataProvider('provideDecodeHeader')]
    public function testDecodeHeader(string $tokenString, array $awaitedJose, array $awaitedClaims, string $awaitedSignature): void
    {
        $awaitedToken = $this->getMockBuilder(Jwt::class)->getMock();

        /** @var MockObject&JwtBuilder */
        $builder = $this->getMockBuilder(JwtBuilder::class)->getMock();
        $builder->expects($this->once())
            ->method('setJoseParams')
            ->with(
                $this->identicalTo($awaitedJose)
            )
            ->willReturn($builder)
        ;
        $builder->expects($this->once())
            ->method('setClaims')
            ->with(
                $this->identicalTo($awaitedClaims)
            )
            ->willReturn($builder)
        ;
        $builder->expects($this->once())
            ->method('setSignature')
            ->with(
                $this->identicalTo($awaitedSignature)
            )
            ->willReturn($builder)
        ;
        $builder->expects($this->once())
            ->method('build')
            ->willReturn($awaitedToken)
        ;

        $decoder = new Decoder($builder);
        $token = $decoder->decodeHeader($tokenString);

        $this->assertSame($awaitedToken, $token);
    }

    public static function provideDecodeHeader(): array
    {
        return [
            'simple token' => [
                'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9'
                    . '.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ'
                    . '.xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8',
                [
                    'alg' => 'HS256',
                    'typ' => 'JWT',
                ],
                [
                    'sub' => '1234567890',
                    'name' => 'John Doe',
                    'iat' => 1516239022,
                ],
                Base64::urlDecode('xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8'),
            ],
            'token with leading ant tailing spaces' => [
                '    Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9'
                    . '.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ'
                    . '.xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8  ',
                [
                    'alg' => 'HS256',
                    'typ' => 'JWT',
                ],
                [
                    'sub' => '1234567890',
                    'name' => 'John Doe',
                    'iat' => 1516239022,
                ],
                Base64::urlDecode('xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8'),
            ],
            'token with another case' => [
                'bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9'
                    . '.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ'
                    . '.xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8',
                [
                    'alg' => 'HS256',
                    'typ' => 'JWT',
                ],
                [
                    'sub' => '1234567890',
                    'name' => 'John Doe',
                    'iat' => 1516239022,
                ],
                Base64::urlDecode('xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8'),
            ],
        ];
    }

    public function testDecodeHeaderWrongHeaderException(): void
    {
        /** @var MockObject&JwtBuilder */
        $builder = $this->getMockBuilder(JwtBuilder::class)->getMock();

        $decoder = new Decoder($builder);

        $this->expectException(JwtException::class);
        $decoder->decodeHeader('test');
    }

    public function testIncompleteTokenException(): void
    {
        /** @var MockObject&JwtBuilder */
        $builder = $this->getMockBuilder(JwtBuilder::class)->getMock();

        $decoder = new Decoder($builder);

        $this->expectExceptionObject(new JwtException('Token string must contain 3 parts'));
        $decoder->decodeString('test');
    }

    public function testBadJsonException(): void
    {
        /** @var MockObject&JwtBuilder */
        $builder = $this->getMockBuilder(JwtBuilder::class)->getMock();

        $decoder = new Decoder($builder);

        $this->expectException(JwtException::class);
        $decoder->decodeString('test.test.test');
    }
}
