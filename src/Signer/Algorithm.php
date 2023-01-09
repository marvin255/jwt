<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Enum for algorithms names.
 */
enum Algorithm: string
{
    case HMAC_SHA_256 = 'HS256';
    case HMAC_SHA_384 = 'HS384';
    case HMAC_SHA_512 = 'HS512';
    case RSA_SHA_256 = 'RS256';
    case RSA_SHA_384 = 'RS384';
    case RSA_SHA_512 = 'RS512';
    case NONE = 'none';

    public function getPhpAlgName(): string
    {
        return match ($this) {
            Algorithm::HMAC_SHA_256 => 'sha256',
            Algorithm::HMAC_SHA_384 => 'sha384',
            Algorithm::HMAC_SHA_512 => 'sha512',
            Algorithm::RSA_SHA_256 => (string) \OPENSSL_ALGO_SHA256,
            Algorithm::RSA_SHA_384 => (string) \OPENSSL_ALGO_SHA384,
            Algorithm::RSA_SHA_512 => (string) \OPENSSL_ALGO_SHA512,
            default => '',
        };
    }
}
