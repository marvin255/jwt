<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 256 signer.
 */
final class RsaSha256Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgHeader(): string
    {
        return Algorithm::RSA_SHA_256;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPHPAlgName(): int
    {
        return \OPENSSL_ALGO_SHA256;
    }
}
