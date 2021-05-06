<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Hmac sha 384 signer.
 */
class HmacSha384Signer extends Hmac
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgHeader(): string
    {
        return Algorithm::HMAC_SHA_384;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPHPAlgName(): string
    {
        return 'sha384';
    }
}
