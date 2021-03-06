<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Signer;

use Marvin255\Jwt\Exception\SecretKeyIsInvalid;
use Marvin255\Jwt\Helper\Base64;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Token\JoseHeader;
use OpenSSLAsymmetricKey;

/**
 * Abstract class for signers based on rsa.
 *
 * @internal
 */
abstract class Rsa implements JwtSigner
{
    private ?Secret $public;

    private ?Secret $private;

    public function __construct(?Secret $public = null, ?Secret $private = null)
    {
        $this->public = $public;
        $this->private = $private;
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
     * @return int
     */
    abstract protected function getPHPAlgName(): int;

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
     *
     * @throws SecretKeyIsInvalid
     *
     * @psalm-suppress InvalidArgument
     */
    public function createSignature(array $joseParams, array $claims): string
    {
        if ($this->private === null) {
            $message = 'Private key is needed to create new signature.';
            throw new SecretKeyIsInvalid($message);
        }

        $data = Base64::arrayEncode($joseParams) . '.' . Base64::arrayEncode($claims);
        $privateKey = $this->openPrivateKey($this->private);

        openssl_sign($data, $signature, $privateKey, $this->getPHPAlgName());

        return $signature;
    }

    /**
     * {@inheritDoc}
     *
     * @throws SecretKeyIsInvalid
     *
     * @psalm-suppress InvalidArgument
     */
    public function verifyToken(Jwt $token): bool
    {
        if ($this->public === null) {
            $message = 'Public key is needed to create new signature.';
            throw new SecretKeyIsInvalid($message);
        }

        $joseParams = $token->jose()->toArray();
        $claims = $token->claims()->toArray();
        $data = Base64::arrayEncode($joseParams) . '.' . Base64::arrayEncode($claims);
        $signature = $token->signature()->getSignatureString();
        $publicKey = $this->openPublicKey($this->public);

        $res = openssl_verify($data, $signature, $publicKey, $this->getPHPAlgName());

        return $res === 1;
    }

    /**
     * Opens private key for open_ssl lib.
     *
     * @param Secret $key
     *
     * @return OpenSSLAsymmetricKey
     *
     * @psalm-suppress RedundantCondition
     * @psalm-suppress PossiblyNullArgument
     */
    private function openPrivateKey(Secret $secret): OpenSSLAsymmetricKey
    {
        $key = openssl_pkey_get_private(
            $secret->getSecret(),
            $secret->getPassPhrase()
        );

        if (!($key instanceof OpenSSLAsymmetricKey)) {
            $message = 'Private key for RSA is invalid or malformed. Correct PEM key is required.';
            throw new SecretKeyIsInvalid($message);
        }

        return $key;
    }

    /**
     * Opens public key for open_ssl lib.
     *
     * @param Secret $key
     *
     * @return OpenSSLAsymmetricKey
     *
     * @psalm-suppress RedundantCondition
     * @psalm-suppress PossiblyNullArgument
     */
    private function openPublicKey(Secret $secret): OpenSSLAsymmetricKey
    {
        $key = openssl_pkey_get_public($secret->getSecret());

        if (!($key instanceof OpenSSLAsymmetricKey)) {
            $message = 'Public key for RSA is invalid or malformed. Correct PEM key is required.';
            throw new SecretKeyIsInvalid($message);
        }

        return $key;
    }
}
