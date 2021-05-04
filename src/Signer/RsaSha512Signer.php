<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 512 signer.
 */
class RsaSha512Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgHeader(): string
    {
        return 'RS512';
    }

    /**
     * {@inheritDoc}
     */
    protected function getPHPAlgName(): int
    {
        return \OPENSSL_ALGO_SHA512;
    }
}
