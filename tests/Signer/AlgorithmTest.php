<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Signer\Algorithm;
use Marvin255\Jwt\Signer\AlgorithmType;
use Marvin255\Jwt\Signer\HmacSha256Signer;
use Marvin255\Jwt\Signer\HmacSha384Signer;
use Marvin255\Jwt\Signer\HmacSha512Signer;
use Marvin255\Jwt\Signer\NoneSigner;
use Marvin255\Jwt\Signer\RsaSha256Signer;
use Marvin255\Jwt\Signer\RsaSha384Signer;
use Marvin255\Jwt\Signer\RsaSha512Signer;
use Marvin255\Jwt\Test\BaseCase;

/**
 * @internal
 */
class AlgorithmTest extends BaseCase
{
    /**
     * @dataProvider provideGetPhpAlgName
     */
    public function testGetPhpAlgName(Algorithm $alg, string $result): void
    {
        $this->assertSame($result, $alg->getPhpAlgName());
    }

    public function provideGetPhpAlgName(): array
    {
        return [
            'default' => [
                Algorithm::NONE,
                '',
            ],
            'rsa converts to string' => [
                Algorithm::RSA_SHA_256,
                (string) \OPENSSL_ALGO_SHA256,
            ],
        ];
    }

    /**
     * @dataProvider provideGetImplementation
     */
    public function testGetImplementation(Algorithm $alg, string $result): void
    {
        $this->assertSame($result, $alg->getImplementation());
    }

    public function provideGetImplementation(): array
    {
        return [
            'NONE' => [
                Algorithm::NONE,
                NoneSigner::class,
            ],
            'HMAC_SHA_256' => [
                Algorithm::HMAC_SHA_256,
                HmacSha256Signer::class,
            ],
            'HMAC_SHA_384' => [
                Algorithm::HMAC_SHA_384,
                HmacSha384Signer::class,
            ],
            'HMAC_SHA_512' => [
                Algorithm::HMAC_SHA_512,
                HmacSha512Signer::class,
            ],
            'RSA_SHA_256' => [
                Algorithm::RSA_SHA_256,
                RsaSha256Signer::class,
            ],
            'RSA_SHA_384' => [
                Algorithm::RSA_SHA_384,
                RsaSha384Signer::class,
            ],
            'RSA_SHA_512' => [
                Algorithm::RSA_SHA_512,
                RsaSha512Signer::class,
            ],
        ];
    }

    /**
     * @dataProvider provideTestGetType
     */
    public function testGetType(Algorithm $alg, AlgorithmType $result): void
    {
        $this->assertSame($result, $alg->getType());
    }

    public function provideTestGetType(): array
    {
        return [
            'NONE' => [
                Algorithm::NONE,
                AlgorithmType::NONE,
            ],
            'HMAC_SHA_256' => [
                Algorithm::HMAC_SHA_256,
                AlgorithmType::HMAC,
            ],
            'HMAC_SHA_384' => [
                Algorithm::HMAC_SHA_384,
                AlgorithmType::HMAC,
            ],
            'HMAC_SHA_512' => [
                Algorithm::HMAC_SHA_512,
                AlgorithmType::HMAC,
            ],
            'RSA_SHA_256' => [
                Algorithm::RSA_SHA_256,
                AlgorithmType::RSA,
            ],
            'RSA_SHA_384' => [
                Algorithm::RSA_SHA_384,
                AlgorithmType::RSA,
            ],
            'RSA_SHA_512' => [
                Algorithm::RSA_SHA_512,
                AlgorithmType::RSA,
            ],
        ];
    }
}
