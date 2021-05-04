<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Token\Token;

/**
 * Interface for builder object that can create new jwt.
 */
interface JwtBuilder
{
    /**
     * Sets new JOSE header param with value.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return JwtBuilder
     */
    public function setJoseParam(string $name, mixed $value): JwtBuilder;

    /**
     * Sets array of JOSE header params.
     *
     * @param array $params
     *
     * @return JwtBuilder
     */
    public function setJoseParams(array $params): JwtBuilder;

    /**
     * Sets new claim with value.
     *
     * @param string $name
     * @param mixed  $value
     *
     * @return JwtBuilder
     */
    public function setClaim(string $name, mixed $value): JwtBuilder;

    /**
     * Sets array of claims.
     *
     * @param array $claims
     *
     * @return JwtBuilder
     */
    public function setClaims(array $claims): JwtBuilder;

    /**
     * Sets signature.
     *
     * @param string $signature
     *
     * @return JwtBuilder
     */
    public function setSignature(string $signature): JwtBuilder;

    /**
     * Signs token with set signer.
     *
     * @param JwtSigner $signer
     *
     * @return JwtBuilder
     */
    public function signWith(JwtSigner $signer): JwtBuilder;

    /**
     * Creates new token from state of current builder.
     *
     * @return Jwt
     */
    public function create(): Jwt;
}
