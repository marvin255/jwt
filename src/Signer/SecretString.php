<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Object that stores secret in the internal field.
 */
class SecretString implements Secret
{
    private string $secret;

    private ?string $passPhrase;

    public function __construct(string $secret, ?string $passPhrase = null)
    {
        $this->secret = $secret;
        $this->passPhrase = $passPhrase;
    }

    /**
     * {@inheritDoc}
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * {@inheritDoc}
     */
    public function getPassPhrase(): ?string
    {
        return $this->passPhrase;
    }
}
