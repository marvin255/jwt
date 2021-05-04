<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Token\JoseHeader;

/**
 * Signer for non signed tokens.
 */
class NoneSigner implements JwtSigner
{
    /**
     * {@inheritDoc}
     */
    public function updateJoseParams(array $params): array
    {
        $params[JoseHeader::ALG] = 'none';

        return $params;
    }

    /**
     * {@inheritDoc}
     */
    public function createSignature(array $joseParams, array $claims): string
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    public function verifyToken(Jwt $token): bool
    {
        return $token->signature()->getSignatureString() === '';
    }
}
