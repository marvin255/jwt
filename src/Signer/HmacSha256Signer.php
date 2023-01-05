<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Hmac sha 256 signer.
 */
final class HmacSha256Signer extends Hmac
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgHeader(): string
    {
        return Algorithm::HMAC_SHA_256;
    }

    /**
     * {@inheritDoc}
     */
    protected function getPHPAlgName(): string
    {
        return 'sha256';
    }
}
