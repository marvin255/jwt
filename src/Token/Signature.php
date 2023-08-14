<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

/**
 * Object that represents jwt signature.
 */
final class Signature
{
    public function __construct(private readonly string $signature = '')
    {
    }

    /**
     * Returns signature string.
     */
    public function getSignatureString(): string
    {
        return $this->signature;
    }
}
