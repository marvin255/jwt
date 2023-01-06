<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

use Marvin255\Optional\Optional;

/**
 * Object that represents JOSE header for token.
 */
final class JoseHeader extends ParamSet
{
    /**
     * Return typ header value.
     *
     * @return Optional<string>
     */
    public function typ(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::TYP->value);
    }

    /**
     * Return cty header value.
     *
     * @return Optional<string>
     */
    public function cty(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::CTY->value);
    }

    /**
     * Return alg header value.
     *
     * @return Optional<string>
     */
    public function alg(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::ALG->value);
    }

    /**
     * Return jku header value.
     *
     * @return Optional<string>
     */
    public function jku(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::JKU->value);
    }

    /**
     * Return jwk header value.
     *
     * @return Optional<string>
     */
    public function jwk(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::JWK->value);
    }

    /**
     * Return kid header value.
     *
     * @return Optional<string>
     */
    public function kid(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::KID->value);
    }

    /**
     * Return x5u header value.
     *
     * @return Optional<string>
     */
    public function x5u(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::X5U->value);
    }

    /**
     * Return x5u header value.
     *
     * @return Optional<string>
     */
    public function x5c(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::X5C->value);
    }

    /**
     * Return x5t header value.
     *
     * @return Optional<string>
     */
    public function x5t(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::X5T->value);
    }

    /**
     * Return x5t#S256 header value.
     *
     * @return Optional<string>
     */
    public function x5t256(): Optional
    {
        return $this->getOptionalString(JoseHeaderParams::X5T256->value);
    }

    /**
     * Return crit header value.
     *
     * @return Optional<array>
     */
    public function crit(): Optional
    {
        return $this->getOptionalArray(JoseHeaderParams::CRIT->value);
    }
}
