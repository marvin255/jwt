<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

/**
 * List of builtin jose params.
 */
enum ClaimSetParams: string
{
    case ISS = 'iss';
    case SUB = 'sub';
    case AUD = 'aud';
    case EXP = 'exp';
    case JTI = 'jti';
    case NBF = 'nbf';
    case IAT = 'iat';
}
