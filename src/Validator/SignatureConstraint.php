<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtSigner;

/**
 * Constraint that checks that token hav valid signature.
 */
final class SignatureConstraint implements Constraint
{
    private readonly JwtSigner $signer;

    public function __construct(JwtSigner $signer)
    {
        $this->signer = $signer;
    }

    /**
     * {@inheritDoc}
     */
    public function checkToken(Jwt $token): bool
    {
        return $this->signer->verifyToken($token);
    }

    /**
     * {@inheritDoc}
     */
    public function createErrorMessage(Jwt $token): string
    {
        return 'Token has invalid or malformed signature.';
    }
}
