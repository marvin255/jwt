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
     * @param mixed[] $params
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
     * @param mixed[] $claims
     *
     * @return JwtBuilder
     */
    public function setClaims(array $claims): JwtBuilder;

    /**
     * Sets iss claim value.
     *
     * @param string $iss
     *
     * @return JwtBuilder
     */
    public function setIss(string $iss): JwtBuilder;

    /**
     * Sets sub claim value.
     *
     * @param string $sub
     *
     * @return JwtBuilder
     */
    public function setSub(string $sub): JwtBuilder;

    /**
     * Sets aud claim value.
     *
     * @param mixed $aud
     *
     * @return JwtBuilder
     */
    public function setAud(mixed $aud): JwtBuilder;

    /**
     * Sets exp claim value.
     *
     * @param int $exp
     *
     * @return JwtBuilder
     */
    public function setExp(int $exp): JwtBuilder;

    /**
     * Sets nbf claim value.
     *
     * @param int $nbf
     *
     * @return JwtBuilder
     */
    public function setNbf(int $nbf): JwtBuilder;

    /**
     * Sets iat claim value.
     *
     * @param int $iat
     *
     * @return JwtBuilder
     */
    public function setIat(int $iat): JwtBuilder;

    /**
     * Sets jti claim value.
     *
     * @param string $jti
     *
     * @return JwtBuilder
     */
    public function setJti(string $jti): JwtBuilder;

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
    public function build(): Jwt;
}
