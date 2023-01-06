<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

/**
 * Interface for builder object that can create new jwt.
 */
interface JwtBuilder
{
    /**
     * Sets new JOSE header param with value.
     */
    public function setJoseParam(string $name, mixed $value): JwtBuilder;

    /**
     * Sets array of JOSE header params.
     *
     * @param array<string, mixed> $params
     */
    public function setJoseParams(array $params): JwtBuilder;

    /**
     * Sets new claim with value.
     */
    public function setClaim(string $name, mixed $value): JwtBuilder;

    /**
     * Sets array of claims.
     *
     * @param array<string, mixed> $claims
     */
    public function setClaims(array $claims): JwtBuilder;

    /**
     * Sets iss claim value.
     */
    public function setIss(string $iss): JwtBuilder;

    /**
     * Sets sub claim value.
     */
    public function setSub(string $sub): JwtBuilder;

    /**
     * Sets aud claim value.
     */
    public function setAud(mixed $aud): JwtBuilder;

    /**
     * Sets exp claim value.
     */
    public function setExp(int $exp): JwtBuilder;

    /**
     * Sets nbf claim value.
     */
    public function setNbf(int $nbf): JwtBuilder;

    /**
     * Sets iat claim value.
     */
    public function setIat(int $iat): JwtBuilder;

    /**
     * Sets jti claim value.
     */
    public function setJti(string $jti): JwtBuilder;

    /**
     * Sets signature.
     */
    public function setSignature(string $signature): JwtBuilder;

    /**
     * Signs token with set signer.
     */
    public function signWith(JwtSigner $signer): JwtBuilder;

    /**
     * Creates new token from state of current builder.
     */
    public function build(): Jwt;
}
