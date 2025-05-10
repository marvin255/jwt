<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Encoder;

use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtEncoder;

/**
 * Basic encoder that converts token object to string.
 */
final class Encoder implements JwtEncoder
{
    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function encode(Jwt $token): string
    {
        $tokenParts = [
            Base64::arrayEncode($token->jose()->toArray()),
            Base64::arrayEncode($token->claims()->toArray()),
            Base64::urlEncode($token->signature()->getSignatureString()),
        ];

        return implode('.', $tokenParts);
    }
}
