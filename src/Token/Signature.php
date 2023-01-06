<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

/**
 * Object that represents jwt signature.
 */
final class Signature
{
    private readonly string $signature;

    /**
     * @param string $signature
     */
    public function __construct(string $signature = '')
    {
        $this->signature = $signature;
    }

    /**
     * Returns signature string.
     */
    public function getSignatureString(): string
    {
        return $this->signature;
    }
}
