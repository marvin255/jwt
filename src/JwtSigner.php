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
     * @return array<string, mixed>
     */
    public function updateJoseParams(array $params): array;

    /**
     * Creates signature for set params.
     *
     * @param array $joseParams
     * @param array $claims
     *
     * @return string
     */
    public function createSignature(array $joseParams, array $claims): string;

    /**
     * Verifies token signature.
     *
     * @param Jwt $token
     *
     * @return bool
     */
    public function verifyToken(Jwt $token): bool;
}
