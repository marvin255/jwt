<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Decoder;

use Marvin255\Jwt\Decoder\Decoder;
use Marvin255\Jwt\Exception\JwtException;
use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtBuilder;
use Marvin255\Jwt\Test\BaseCase;

/**
 * @internal
 */
class DecoderTest extends BaseCase
{
    public function testDecodeHeader(): void
    {
        $awaitedJose = [
            'alg' => 'HS256',
            'typ' => 'JWT',
        ];
        $awaitedClaims = [
            'sub' => '1234567890',
            'name' => 'John Doe',
            'iat' => 1516239022,
        ];
        $awaitedSignature = Base64::urlDecode('xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8');
        $tokenString = 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9'
            . '.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ'
            . '.xGknUYTHzJEQ5YIp2cXaZpU4m0RPJtqBZHjowGQGMx8';
        $awaitedToken = $this->getMockBuilder(Jwt::class)->getMock();

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
            ->method('create')
            ->willReturn($awaitedToken)
        ;

        $decoder = new Decoder($builder);
        $token = $decoder->decodeHeader($tokenString);

        $this->assertSame($awaitedToken, $token);
    }

    public function testDecodeHeaderWrongHeaderException(): void
    {
        $builder = $this->getMockBuilder(JwtBuilder::class)->getMock();

        $decoder = new Decoder($builder);

        $this->expectException(JwtException::class);
        $decoder->decodeHeader('test');
    }

    public function testIncompleteTokenException(): void
    {
        $builder = $this->getMockBuilder(JwtBuilder::class)->getMock();

        $decoder = new Decoder($builder);

        $this->expectException(JwtException::class);
        $decoder->decodeString('test');
    }

    public function testBadJsonException(): void
    {
        $builder = $this->getMockBuilder(JwtBuilder::class)->getMock();

        $decoder = new Decoder($builder);

        $this->expectException(JwtException::class);
        $decoder->decodeString('test.test.test');
    }
}
