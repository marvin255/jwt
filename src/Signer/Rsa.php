<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Exception\SecretKeyIsInvalid;
use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Token\JoseHeaderParams;

/**
 * Abstract class for signers based on rsa.
 *
 * @internal
 */
abstract class Rsa implements JwtSigner
{
    private readonly ?Secret $public;

    private readonly ?Secret $private;

    public function __construct(?Secret $public = null, ?Secret $private = null)
    {
        $this->public = $public;
        $this->private = $private;
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
        if ($this->private === null) {
            throw new SecretKeyIsInvalid('Private key is needed to create new signature');
        }

        $data = Base64::arrayEncode($joseParams) . '.' . Base64::arrayEncode($claims);
        $privateKey = $this->openPrivateKey($this->private);

        openssl_sign(
            $data,
            $signature,
            $privateKey,
            (int) $this->getAlgorithm()->getPhpAlgName()
        );

        return $signature;
    }

    /**
     * {@inheritDoc}
     */
    public function verifyToken(Jwt $token): bool
    {
        if ($this->public === null) {
            throw new SecretKeyIsInvalid('Public key is needed to create new signature');
        }

        $joseParams = $token->jose()->toArray();
        $claims = $token->claims()->toArray();
        $data = Base64::arrayEncode($joseParams) . '.' . Base64::arrayEncode($claims);
        $signature = $token->signature()->getSignatureString();
        $publicKey = $this->openPublicKey($this->public);

        $res = openssl_verify(
            $data,
            $signature,
            $publicKey,
            (int) $this->getAlgorithm()->getPhpAlgName()
        );

        return $res === 1;
    }

    /**
     * Opens private key for open_ssl lib.
     */
    private function openPrivateKey(Secret $secret): \OpenSSLAsymmetricKey
    {
        $key = openssl_pkey_get_private(
            $secret->getSecret(),
            $secret->getPassPhrase()
        );

        if (!($key instanceof \OpenSSLAsymmetricKey)) {
            throw new SecretKeyIsInvalid('Private key for RSA is invalid or malformed. Correct PEM key is required');
        }

        return $key;
    }

    /**
     * Opens public key for open_ssl lib.
     */
    private function openPublicKey(Secret $secret): \OpenSSLAsymmetricKey
    {
        $key = openssl_pkey_get_public($secret->getSecret());

        if (!($key instanceof \OpenSSLAsymmetricKey)) {
            throw new SecretKeyIsInvalid('Public key for RSA is invalid or malformed. Correct PEM key is required');
        }

        return $key;
    }
}
