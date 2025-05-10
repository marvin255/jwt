<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Token\JoseHeaderParams;

/**
 * Signer for non signed tokens.
 *
 * @internal
 */
final class NoneSigner implements JwtSigner
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function updateJoseParams(array $params): array
    {
        $params[JoseHeaderParams::ALG->value] = Algorithm::NONE->value;

        return $params;
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function createSignature(array $joseParams, array $claims): string
    {
        return '';
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function verifyToken(Jwt $token): bool
    {
        return $token->signature()->getSignatureString() === '';
    }
}
