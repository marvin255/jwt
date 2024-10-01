<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

use Marvin255\Jwt\Jwt;

/**
 * Basic token object.
 */
final class Token implements Jwt
{
    public function __construct(
        private readonly JoseHeader $jose,
        private readonly ClaimSet $claims,
        private readonly Signature $signature,
    ) {
    }

    /**
     * {@inheritDoc}
     */
    public function jose(): JoseHeader
    {
        return $this->jose;
    }

    /**
     * {@inheritDoc}
     */
    public function claims(): ClaimSet
    {
        return $this->claims;
    }

    /**
     * {@inheritDoc}
     */
    public function signature(): Signature
    {
        return $this->signature;
    }
}
