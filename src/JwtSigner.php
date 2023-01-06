<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

/**
 * Interface for object that can sign token.
 */
interface JwtSigner
{
    /**
     * Updates list of JOSE headers for token.
     *
     * @param array<string, mixed> $params
     *
     * @return array<string, mixed>
     */
    public function updateJoseParams(array $params): array;

    /**
     * Creates signature for set params.
     *
     * @param array<string, mixed> $joseParams
     * @param array<string, mixed> $claims
     */
    public function createSignature(array $joseParams, array $claims): string;

    /**
     * Verifies token signature.
     */
    public function verifyToken(Jwt $token): bool;
}
