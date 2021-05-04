<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Exception\SecretFileNotFoundException;
use SplFileInfo;

/**
 * Object that can read secret from file.
 */
class SecretFile implements Secret
{
    private SplFileInfo $file;

    private ?string $passPhrase;

    private ?string $secret = null;

    public function __construct(SplFileInfo | string $file, ?string $passPhrase = null)
    {
        if (\is_string($file)) {
            $file = new SplFileInfo($file);
        }

        if (!$file->isFile() || !$file->isReadable()) {
            $message = sprintf('Secret file %s not found or unreadable.', $file->getRealPath());
            throw new SecretFileNotFoundException($message);
        }

        $this->file = $file;
        $this->passPhrase = $passPhrase;
    }

    /**
     * {@inheritDoc}
     */
    public function getSecret(): string
    {
        if ($this->secret === null) {
            $content = (string) file_get_contents($this->file->getRealPath());
            $this->secret = $content;
        }

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
