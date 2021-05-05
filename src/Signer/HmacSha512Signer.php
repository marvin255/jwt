<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Hmac sha 512 signer.
 */
class HmacSha512Signer extends Hmac
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgHeader(): string
    {
        return Algorithm::HMAC_SHA_512;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPHPAlgName(): string
    {
        return 'sha512';
    }
}
