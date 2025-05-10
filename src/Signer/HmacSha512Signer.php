<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Hmac sha 512 signer.
 *
 * @internal
 */
final class HmacSha512Signer extends Hmac
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    protected function getAlgorithm(): Algorithm
    {
        return Algorithm::HMAC_SHA_512;
    }
}
