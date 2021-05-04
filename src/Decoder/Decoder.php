<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Decoder;

use Marvin255\Jwt\Exception\JwtException;
use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtBuilder;
use Marvin255\Jwt\JwtDecoder;
use Throwable;

/**
 * Basic decoder that converts string to token object.
 */
class Decoder implements JwtDecoder
{
    private JwtBuilder $builder;

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
        [$joseParams, $claims, $signature] = $decodedTokenParts;

        return $this->builder
            ->setJoseParams($joseParams)
            ->setClaims($claims)
            ->setSignature($signature)
            ->build()
        ;
    }

    /**
     * {@inheritDoc}
     */
    public function decodeHeader(string $httpHeader): Jwt
    {
        if (!preg_match('/^(?:\s+)?Bearer\s(.+)$/', $httpHeader, $matches)) {
            $message = sprintf("Can't recognize jwt header in string: %s.", $httpHeader);
            throw new JwtException($message);
        }

        return $this->decodeString($matches[1]);
    }

    /**
     * Explodes token to a basic parts.
     *
     * @param string $token
     *
     * @return string[]
     */
    private function explodeToken(string $token): array
    {
        $tokenParts = explode('.', $token);

        if (\count($tokenParts) !== 3) {
            $message = 'Token string must contains 3 parts.';
            throw new JwtException($message);
        }

        return $tokenParts;
    }

    /**
     * Decodes token parts to arrays.
     *
     * @param string[] $tokenParts
     *
     * @return array
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
     *
     * @param string $part
     *
     * @return array
     */
    private function decodeJsonObject(string $part): array
    {
        try {
            $decoded = Base64::arrayDecode($part);
        } catch (Throwable $e) {
            $message = sprintf("Can't decode token object: %s.", $e->getMessage());
            throw new JwtException($message);
        }

        return $decoded;
    }
}
