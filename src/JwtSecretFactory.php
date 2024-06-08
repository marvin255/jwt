<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Signer\Secret;
use Marvin255\Jwt\Signer\SecretBase;

/**
 * Factory object for Secrets.
 */
final class JwtSecretFactory
{
    private function __construct()
    {
    }

    /**
     * Creates object that contains key secret.
     */
    public static function create(string $secret, ?string $passPhrase = null): Secret
    {
        return new SecretBase($secret, $passPhrase);
    }
}
