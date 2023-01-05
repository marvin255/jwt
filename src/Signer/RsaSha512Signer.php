<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 512 signer.
 */
final class RsaSha512Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgHeader(): string
    {
        return Algorithm::RSA_SHA_512;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPHPAlgName(): int
    {
        return \OPENSSL_ALGO_SHA512;
    }
}
