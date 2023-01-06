<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

use Marvin255\Optional\Optional;

/**
 * Object that represents claim set for token.
 */
final class ClaimSet extends ParamSet
{
    /**
     * Return iss claim value.
     *
     * @return Optional<string>
     */
    public function iss(): Optional
    {
        return $this->getOptionalString(ClaimSetParams::ISS->value);
    }

    /**
     * Return sub claim value.
     *
     * @return Optional<string>
     */
    public function sub(): Optional
    {
        return $this->getOptionalString(ClaimSetParams::SUB->value);
    }

    /**
     * Return aud claim value.
     *
     * @return Optional<mixed>
     */
    public function aud(): Optional
    {
        return $this->param(ClaimSetParams::AUD->value);
    }

    /**
     * Return exp claim value.
     *
     * @return Optional<int>
     */
    public function exp(): Optional
    {
        return $this->getOptionalInt(ClaimSetParams::EXP->value);
    }

    /**
     * Return nbf claim value.
     *
     * @return Optional<int>
     */
    public function nbf(): Optional
    {
        return $this->getOptionalInt(ClaimSetParams::NBF->value);
    }

    /**
     * Return iat claim value.
     *
     * @return Optional<int>
     */
    public function iat(): Optional
    {
        return $this->getOptionalInt(ClaimSetParams::IAT->value);
    }

    /**
     * Return jti claim value.
     *
     * @return Optional<string>
     */
    public function jti(): Optional
    {
        return $this->getOptionalString(ClaimSetParams::JTI->value);
    }
}
