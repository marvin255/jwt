<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Decoder;

use Marvin255\Jwt\Exception\JwtException;
use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtBuilder;
use Marvin255\Jwt\JwtDecoder;

/**
 * Basic decoder that converts string to token object.
 */
final class Decoder implements JwtDecoder
{
    public function __construct(private readonly JwtBuilder $builder)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function decodeString(string $tokenString): Jwt
    {
        $tokenParts = $this->explodeToken($tokenString);

        $this->builder->setJoseParams(
            $this->decodeJsonObject($tokenParts[0])
        );

        $this->builder->setClaims(
            $this->decodeJsonObject($tokenParts[1])
        );

        $this->builder->setSignature(
            Base64::urlDecode($tokenParts[2])
        );

        return $this->builder->build();
    }

    /**
     * {@inheritDoc}
     */
    public function decodeHeader(string $httpHeader): Jwt
    {
        if (!preg_match('/Bearer\s(.+)/i', $httpHeader, $matches)) {
            throw new JwtException(\sprintf("Can't recognize jwt header in string: %s", $httpHeader));
        }

        return $this->decodeString($matches[1]);
    }

    /**
     * Explodes token to a basic parts.
     *
     * @return string[]
     *
     * @psalm-return list{string, string, string}
     */
    private function explodeToken(string $token): array
    {
        $tokenParts = explode('.', $token);

        if (\count($tokenParts) !== 3) {
            throw new JwtException('Token string must contain 3 parts');
        }

        return $tokenParts;
    }

    /**
     * Decodes token part that contains object to array.
     *
     * @return array<string, mixed>
     */
    private function decodeJsonObject(string $part): array
    {
        try {
            /** @var array<string, mixed> */
            $decoded = Base64::arrayDecode($part);
        } catch (\Throwable $e) {
            throw new JwtException(\sprintf("Can't decode token object: %s", $e->getMessage()));
        }

        return $decoded;
    }
}
