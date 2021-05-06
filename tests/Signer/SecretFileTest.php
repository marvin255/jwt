<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Exception\SecretFileNotFoundException;
use Marvin255\Jwt\Signer\SecretFile;
use Marvin255\Jwt\Test\BaseCase;
use SplFileInfo;

/**
 * @internal
 */
class SecretFileTest extends BaseCase
{
    public function testGetSecret(): void
    {
        $filePath = __DIR__ . '/_fixtures/SecretFileTest.key';

        $secret = new SecretFile($filePath);
        $secretString = $secret->getSecret();

        $this->assertSame(file_get_contents($filePath), $secretString);
    }

    public function testGetSecretWithFileInTheBeggining(): void
    {
        $filePath = 'file://' . __DIR__ . '/_fixtures/SecretFileTest.key';

        $secret = new SecretFile($filePath);
        $secretString = $secret->getSecret();

        $this->assertSame(file_get_contents($filePath), $secretString);
    }

    public function testGetSecretFromSpl(): void
    {
        $filePath = __DIR__ . '/_fixtures/SecretFileTest.key';
        $file = new SplFileInfo($filePath);

        $secret = new SecretFile($file);
        $secretString = $secret->getSecret();

        $this->assertSame(file_get_contents($filePath), $secretString);
    }

    public function testConstructorFileNotFound(): void
    {
        $filePath = __DIR__ . '/_fixtures/SecretFileTest.unexisted';

        $this->expectException(SecretFileNotFoundException::class);
        new SecretFile($filePath);
    }

    public function testGetPassPhrase(): void
    {
        $filePath = __DIR__ . '/_fixtures/SecretFileTest.key';
        $awaitedPassPhrase = 'password';

        $secret = new SecretFile($filePath, $awaitedPassPhrase);
        $passPhrase = $secret->getPassPhrase();

        $this->assertSame($awaitedPassPhrase, $passPhrase);
    }
}
