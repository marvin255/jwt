<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Exception\SecretFileNotFoundException;
use Marvin255\Jwt\Signer\SecretBase;
use Marvin255\Jwt\Test\BaseCase;

/**
 * @internal
 */
class SecretBaseTest extends BaseCase
{
    public function testGetSecret(): void
    {
        $awaitedSecretString = 'test';

        $secret = new SecretBase($awaitedSecretString);
        $secretString = $secret->getSecret();

        $this->assertSame($awaitedSecretString, $secretString);
    }

    public function testGetSecretFromFile(): void
    {
        $filePath = 'file://' . __DIR__ . '/_fixtures/SecretBaseTest_testGetSecretFromFile.key';

        $secret = new SecretBase($filePath);
        $secretString = $secret->getSecret();

        $this->assertSame(file_get_contents($filePath), $secretString);
    }

    public function testGetSecretFromFileNotFound(): void
    {
        $filePath = 'file://' . __DIR__ . '/_fixtures/SecretFileTest.unexisted';

        $secret = new SecretBase($filePath);

        $this->expectException(SecretFileNotFoundException::class);
        $secret->getSecret();
    }

    public function testGetPassPhrase(): void
    {
        $awaitedSecretString = 'test';
        $awaitedPassPhrase = 'password';

        $secret = new SecretBase($awaitedSecretString, $awaitedPassPhrase);
        $passPhrase = $secret->getPassPhrase();

        $this->assertSame($awaitedPassPhrase, $passPhrase);
    }
}
