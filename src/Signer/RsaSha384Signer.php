<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 384 signer.
 *
 * @internal
 */
final class RsaSha384Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    protected function getAlgorithm(): Algorithm
    {
        return Algorithm::RSA_SHA_384;
    }
}
