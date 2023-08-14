<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Token\JoseHeaderParams;

/**
 * Abstract class for signers based on hmac.
 *
 * @internal
 */
abstract class Hmac implements JwtSigner
{
    final public function __construct(private readonly Secret $secret)
    {
    }

    /**
     * Returns algorithm enum for JOSE header.
     */
    abstract protected function getAlgorithm(): Algorithm;

    /**
     * {@inheritDoc}
     */
    public function updateJoseParams(array $params): array
    {
        $params[JoseHeaderParams::ALG->value] = $this->getAlgorithm()->value;

        return $params;
    }

    /**
     * {@inheritDoc}
     */
    public function createSignature(array $joseParams, array $claims): string
    {
        $data = Base64::arrayEncode($joseParams) . '.' . Base64::arrayEncode($claims);

        return hash_hmac(
            $this->getAlgorithm()->getPhpAlgName(),
            $data,
            $this->secret->getSecret()
        );
    }

    /**
     * {@inheritDoc}
     */
    public function verifyToken(Jwt $token): bool
    {
        $tokenSignature = $token->signature()->getSignatureString();
        $calculatedSignature = $this->createSignature(
            $token->jose()->toArray(),
            $token->claims()->toArray()
        );

        return hash_equals($calculatedSignature, $tokenSignature);
    }
}
