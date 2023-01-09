<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Signer\Algorithm;
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
}
