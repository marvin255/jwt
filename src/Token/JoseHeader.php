<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

/**
 * Object that represents JOSE header for token.
 */
class JoseHeader extends ParamSet
{
    public const TYP = 'typ';
    public const CTY = 'cty';
    public const ALG = 'alg';
    public const JKU = 'jku';
    public const JWK = 'jwk';
    public const KID = 'kid';
    public const X5U = 'x5u';
    public const X5C = 'x5c';
    public const X5T = 'x5t';
    public const X5T256 = 'x5t#256';
    public const CRIT = 'crit';

    /**
     * Return typ header value.
     *
     * @return string|null
     */
    public function getTyp(): ?string
    {
        return $this->getOptionalString(self::TYP);
    }

    /**
     * Return cty header value.
     *
     * @return string|null
     */
    public function getCty(): ?string
    {
        return $this->getOptionalString(self::CTY);
    }

    /**
     * Return alg header value.
     *
     * @return string|null
     */
    public function getAlg(): ?string
    {
        return $this->getOptionalString(self::ALG);
    }

    /**
     * Return jku header value.
     *
     * @return string|null
     */
    public function getJku(): ?string
    {
        return $this->getOptionalString(self::JKU);
    }

    /**
     * Return jwk header value.
     *
     * @return string|null
     */
    public function getJwk(): ?string
    {
        return $this->getOptionalString(self::JWK);
    }

    /**
     * Return kid header value.
     *
     * @return string|null
     */
    public function getKid(): ?string
    {
        return $this->getOptionalString(self::KID);
    }

    /**
     * Return x5u header value.
     *
     * @return string|null
     */
    public function getX5u(): ?string
    {
        return $this->getOptionalString(self::X5U);
    }

    /**
     * Return x5u header value.
     *
     * @return string|null
     */
    public function getX5c(): ?string
    {
        return $this->getOptionalString(self::X5C);
    }

    /**
     * Return x5t header value.
     *
     * @return string|null
     */
    public function getX5t(): ?string
    {
        return $this->getOptionalString(self::X5T);
    }

    /**
     * Return x5t#S256 header value.
     *
     * @return string|null
     */
    public function getX5t256(): ?string
    {
        return $this->getOptionalString(self::X5T256);
    }

    /**
     * Return crit header value.
     *
     * @return array|null
     */
    public function getCrit(): ?array
    {
        if ($this->has(self::CRIT)) {
            return (array) $this->get(self::CRIT);
        }

        return null;
    }
}
