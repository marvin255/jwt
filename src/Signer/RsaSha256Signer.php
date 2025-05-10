<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 256 signer.
 *
 * @internal
 */
final class RsaSha256Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    protected function getAlgorithm(): Algorithm
    {
        return Algorithm::RSA_SHA_256;
    }
}
