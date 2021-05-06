<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Exception\SecretFileNotFoundException;

/**
 * Object that stores secret keys for signer.
 */
class SecretBase implements Secret
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
     *
     * @throws SecretFileNotFoundException
     */
    public function getSecret(): string
    {
        $secret = $this->secret;

        if (str_starts_with($this->secret, 'file://')) {
            $filePath = mb_substr($this->secret, 7);
            if (!file_exists($filePath) || !is_readable($filePath)) {
                $message = sprintf('Secret file %s not found or unreadable.', $filePath);
                throw new SecretFileNotFoundException($message);
            }
            $secret = (string) file_get_contents($filePath);
        }

        return $secret;
    }

    /**
     * {@inheritDoc}
     */
    public function getPassPhrase(): ?string
    {
        return $this->passPhrase;
    }
}
