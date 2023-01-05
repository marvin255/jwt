<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

/**
 * Object that represents claim set for token.
 */
final class ClaimSet extends ParamSet
{
    public const ISS = 'iss';
    public const SUB = 'sub';
    public const AUD = 'aud';
    public const EXP = 'exp';
    public const JTI = 'jti';
    public const NBF = 'nbf';
    public const IAT = 'iat';

    /**
     * Return iss claim value.
     *
     * @return string|null
     */
    public function getIss(): ?string
    {
        return $this->getOptionalString(self::ISS);
    }

    /**
     * Return sub claim value.
     *
     * @return string|null
     */
    public function getSub(): ?string
    {
        return $this->getOptionalString(self::SUB);
    }

    /**
     * Return aud claim value.
     *
     * @return mixed
     */
    public function getAud(): mixed
    {
        return $this->get(self::AUD);
    }

    /**
     * Return exp claim value.
     *
     * @return int|null
     */
    public function getExp(): ?int
    {
        return $this->getOptionalInt(self::EXP);
    }

    /**
     * Return nbf claim value.
     *
     * @return int|null
     */
    public function getNbf(): ?int
    {
        return $this->getOptionalInt(self::NBF);
    }

    /**
     * Return iat claim value.
     *
     * @return int|null
     */
    public function getIat(): ?int
    {
        return $this->getOptionalInt(self::IAT);
    }

    /**
     * Return jti claim value.
     *
     * @return string|null
     */
    public function getJti(): ?string
    {
        return $this->getOptionalString(self::JTI);
    }
}
