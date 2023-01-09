<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

use Marvin255\Jwt\Jwt;

/**
 * Basic token object.
 */
final class Token implements Jwt
{
    private readonly JoseHeader $jose;

    private readonly ClaimSet $claims;

    private readonly Signature $signature;

    public function __construct(JoseHeader $jose, ClaimSet $claims, Signature $signature)
    {
        $this->jose = $jose;
        $this->claims = $claims;
        $this->signature = $signature;
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
