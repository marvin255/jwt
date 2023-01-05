<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Token\JoseHeader;

/**
 * Abstract class for signers based on hmac.
 *
 * @internal
 */
abstract class Hmac implements JwtSigner
{
    private readonly Secret $secret;

    public function __construct(Secret $secret)
    {
        $this->secret = $secret;
    }

    /**
     * Returns name of algorithm for JOSE header.
     *
     * @return string
     */
    abstract protected function getAlgHeader(): string;

    /**
     * Returns name of algorithm for JOSE header.
     *
     * @return string
     */
    abstract protected function getPHPAlgName(): string;

    /**
     * {@inheritDoc}
     */
    public function updateJoseParams(array $params): array
    {
        $params[JoseHeader::ALG] = $this->getAlgHeader();

        return $params;
    }

    /**
     * {@inheritDoc}
     */
    public function createSignature(array $joseParams, array $claims): string
    {
        $data = Base64::arrayEncode($joseParams) . '.' . Base64::arrayEncode($claims);

        return hash_hmac(
            $this->getPHPAlgName(),
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
