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
    private readonly JwtBuilder $builder;

    public function __construct(JwtBuilder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * {@inheritDoc}
     */
    public function decodeString(string $tokenString): Jwt
    {
        $tokenParts = $this->explodeToken($tokenString);
        $decodedTokenParts = $this->decodeTokenParts($tokenParts);

        if (!empty($decodedTokenParts[0]) && \is_array($decodedTokenParts[0])) {
            $this->builder->setJoseParams($decodedTokenParts[0]);
        }

        if (!empty($decodedTokenParts[1]) && \is_array($decodedTokenParts[1])) {
            $this->builder->setClaims($decodedTokenParts[1]);
        }

        if (!empty($decodedTokenParts[2]) && \is_string($decodedTokenParts[2])) {
            $this->builder->setSignature($decodedTokenParts[2]);
        }

        return $this->builder->build();
    }

    /**
     * {@inheritDoc}
     */
    public function decodeHeader(string $httpHeader): Jwt
    {
        if (!preg_match('/^(?:\s+)?Bearer\s(.+)$/', $httpHeader, $matches)) {
            throw new JwtException(sprintf("Can't recognize jwt header in string: %s", $httpHeader));
        }

        return $this->decodeString($matches[1]);
    }

    /**
     * Explodes token to a basic parts.
     *
     * @return string[]
     */
    private function explodeToken(string $token): array
    {
        $tokenParts = explode('.', $token);

        if (\count($tokenParts) !== 3) {
            throw new JwtException('Token string must contains 3 parts');
        }

        return $tokenParts;
    }

    /**
     * Decodes token parts to arrays.
     *
     * @param string[] $tokenParts
     *
     * @throws JwtException
     */
    private function decodeTokenParts(array $tokenParts): array
    {
        return [
            $this->decodeJsonObject($tokenParts[0]),
            $this->decodeJsonObject($tokenParts[1]),
            Base64::urlDecode($tokenParts[2]),
        ];
    }

    /**
     * Decodes token part that contains object to array.
     */
    private function decodeJsonObject(string $part): array
    {
        try {
            $decoded = Base64::arrayDecode($part);
        } catch (\Throwable $e) {
            throw new JwtException(sprintf("Can't decode token object: %s", $e->getMessage()));
        }

        return $decoded;
    }
}
