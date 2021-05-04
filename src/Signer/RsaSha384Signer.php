<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 384 signer.
 */
class RsaSha384Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgHeader(): string
    {
        return 'RS384';
    }

    /**
     * {@inheritDoc}
     */
    protected function getPHPAlgName(): int
    {
        return \OPENSSL_ALGO_SHA384;
    }
}
