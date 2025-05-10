<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Exception\SecretFileNotFoundException;

/**
 * Object that stores secret keys for signer.
 *
 * @internal
 */
final class SecretBase implements Secret
{
    private const FILE_PREFIX = 'file://';

    public function __construct(
        private readonly string $secret,
        private readonly ?string $passPhrase = null,
    ) {
    }

    /**
     * {@inheritDoc}
     *
     * @throws SecretFileNotFoundException
     */
    #[\Override]
    public function getSecret(): string
    {
        if (!str_starts_with($this->secret, self::FILE_PREFIX)) {
            return $this->secret;
        }

        $filePath = realpath(substr($this->secret, \strlen(self::FILE_PREFIX)));
        if ($filePath === false) {
            throw new SecretFileNotFoundException(\sprintf('Secret file %s not found or unreadable', $this->secret));
        }

        $secret = file_get_contents($filePath);
        if ($secret === '' || $secret === false) {
            throw new SecretFileNotFoundException(\sprintf('Secret file %s is empty', $this->secret));
        }

        return $secret;
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function getPassPhrase(): ?string
    {
        return $this->passPhrase;
    }
}
