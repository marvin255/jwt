<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Interface for object that stores rsa key or other types of secrets.
 */
interface Secret
{
    /**
     * Return secret as string.
     *
     * @return string
     */
    public function getSecret(): string;

    /**
     * Return password phase for current secret or null if there is no passpharse.
     *
     * @return string
     */
    public function getPassPhrase(): ?string;
}
