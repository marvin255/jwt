<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Hmac sha 384 signer.
 */
final class HmacSha384Signer extends Hmac
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgorithm(): Algorithm
    {
        return Algorithm::HMAC_SHA_384;
    }
}
