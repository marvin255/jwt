<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Exception\SignerAlgorithmNotFoundException;
use Marvin255\Jwt\Signer\Algorithm;
use Marvin255\Jwt\Signer\Rsa;
use Marvin255\Jwt\Signer\Secret;

/**
 * Factory object that can create signer objects.
 */
final class JwtSignerFactory
{
    private function __construct()
    {
    }

    /**
     * Creates RSA signer.
     */
    public static function createRsa(Algorithm $algorithm, Secret $public = null, Secret $private = null): Rsa
    {
        $implementation = $algorithm->getImplementation();
        if (!is_subclass_of($implementation, Rsa::class)) {
            throw new SignerAlgorithmNotFoundException('Wrong algorithm provided');
        }

        return new $implementation($public, $private);
    }
}
