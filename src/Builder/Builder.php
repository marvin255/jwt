<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Builder;

use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtBuilder;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Token\ClaimSet;
use Marvin255\Jwt\Token\ClaimSetParams;
use Marvin255\Jwt\Token\JoseHeader;
use Marvin255\Jwt\Token\Signature;
use Marvin255\Jwt\Token\Token;

/**
 * Builder object for jwt.
 */
final class Builder implements JwtBuilder
{
    /**
     * @var array<string, mixed>
     */
    private array $jose = [];

    /**
     * @var array<string, mixed>
     */
    private array $claims = [];

    private string $signature = '';

    private ?JwtSigner $signer = null;

    /**
     * {@inheritDoc}
     */
    public function setJoseParam(string $name, mixed $value): JwtBuilder
    {
        $this->jose[$name] = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setJoseParams(array $params): JwtBuilder
    {
        foreach ($params as $name => $value) {
            $this->setJoseParam($name, $value);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setClaim(string $name, mixed $value): JwtBuilder
    {
        $this->claims[$name] = $value;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setClaims(array $claims): JwtBuilder
    {
        foreach ($claims as $name => $value) {
            $this->setClaim($name, $value);
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setIss(string $iss): JwtBuilder
    {
        $this->claims[ClaimSetParams::ISS->value] = $iss;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setSub(string $sub): JwtBuilder
    {
        $this->claims[ClaimSetParams::SUB->value] = $sub;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setAud(mixed $aud): JwtBuilder
    {
        $this->claims[ClaimSetParams::AUD->value] = $aud;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setExp(int $exp): JwtBuilder
    {
        $this->claims[ClaimSetParams::EXP->value] = $exp;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setNbf(int $nbf): JwtBuilder
    {
        $this->claims[ClaimSetParams::NBF->value] = $nbf;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setIat(int $iat): JwtBuilder
    {
        $this->claims[ClaimSetParams::IAT->value] = $iat;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setJti(string $jti): JwtBuilder
    {
        $this->claims[ClaimSetParams::JTI->value] = $jti;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function setSignature(string $signature): JwtBuilder
    {
        $this->signature = $signature;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function signWith(JwtSigner $signer): JwtBuilder
    {
        $this->signer = $signer;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function build(): Jwt
    {
        $jose = $this->jose;
        $claims = $this->claims;
        $signatureString = $this->signature;

        if ($this->signer !== null) {
            $jose = $this->signer->updateJoseParams($this->jose);
            $signatureString = $this->signer->createSignature($jose, $claims);
        }

        $jose = new JoseHeader($jose);
        $claims = new ClaimSet($claims);
        $signature = new Signature($signatureString);

        $this->jose = [];
        $this->claims = [];
        $this->signature = '';
        $this->signer = null;

        return new Token($jose, $claims, $signature);
    }
}
