<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Enum for algorithms names.
 */
class Algorithm
{
    public const HMAC_SHA_256 = 'HS256';
    public const HMAC_SHA_384 = 'HS384';
    public const HMAC_SHA_512 = 'HS512';
    public const HMAC = [
        self::HMAC_SHA_256,
        self::HMAC_SHA_384,
        self::HMAC_SHA_512,
    ];

    public const RSA_SHA_256 = 'RS256';
    public const RSA_SHA_384 = 'RS384';
    public const RSA_SHA_512 = 'RS512';
    public const RSA = [
        self::RSA_SHA_256,
        self::RSA_SHA_384,
        self::RSA_SHA_512,
    ];

    public const ALL = [
        self::HMAC_SHA_256,
        self::HMAC_SHA_384,
        self::HMAC_SHA_512,
        self::RSA_SHA_256,
        self::RSA_SHA_384,
        self::RSA_SHA_512,
    ];
}
