<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * RSA sha 384 signer.
 */
final class RsaSha384Signer extends Rsa
{
    /**
     * {@inheritDoc}
     */
    protected function getAlgorithm(): Algorithm
    {
        return Algorithm::RSA_SHA_384;
    }
}
