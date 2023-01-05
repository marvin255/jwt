<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

/**
 * Interface for builder object that can encode token as string.
 */
interface JwtEncoder
{
    /**
     * Encodes token object to string.
     *
     * @param Jwt $token
     *
     * @return string
     */
    public function encode(Jwt $token): string;
}
