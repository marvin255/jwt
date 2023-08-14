<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Exception\SignerAlgorithmNotFoundException;
use Marvin255\Jwt\Signer\Algorithm;
use Marvin255\Jwt\Signer\Hmac;
use Marvin255\Jwt\Signer\NoneSigner;
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

    /**
     * Creates HMAC signer.
     */
    public static function createHmac(Algorithm $algorithm, Secret $secret): Hmac
    {
        $implementation = $algorithm->getImplementation();
        if (!is_subclass_of($implementation, Hmac::class)) {
            throw new SignerAlgorithmNotFoundException('Wrong algorithm provided');
        }

        return new $implementation($secret);
    }

    /**
     * Creates empty signer that does nothing.
     */
    public static function createNone(): NoneSigner
    {
        return new NoneSigner();
    }
}
