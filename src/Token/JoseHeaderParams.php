<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

/**
 * List of builtin jose params.
 */
enum JoseHeaderParams: string
{
    case TYP = 'typ';
    case CTY = 'cty';
    case ALG = 'alg';
    case JKU = 'jku';
    case JWK = 'jwk';
    case KID = 'kid';
    case X5U = 'x5u';
    case X5C = 'x5c';
    case X5T = 'x5t';
    case X5T256 = 'x5t#256';
    case CRIT = 'crit';
}
