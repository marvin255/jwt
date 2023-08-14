<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 512 signer.
 *
 * @internal
 */
final class RsaSha512Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgorithm(): Algorithm
    {
        return Algorithm::RSA_SHA_512;
    }
}
