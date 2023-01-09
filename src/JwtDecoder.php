<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Exception\JwtException;

/**
 * Interface for builder object that can decode token from string.
 */
interface JwtDecoder
{
    /**
     * Decodes token object from string.
     *
     * @throws JwtException
     */
    public function decodeString(string $tokenString): Jwt;

    /**
     * Decodes token object from HTTP header.
     *
     * @throws JwtException
     */
    public function decodeHeader(string $httpHeader): Jwt;
}
