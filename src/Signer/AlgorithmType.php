<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

/**
 * Enum for algorithms types.
 */
enum AlgorithmType: string
{
    case HMAC = 'HMAC';
    case RSA = 'RSA';
    case NONE = 'NONE';
}
