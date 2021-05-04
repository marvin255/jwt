<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Signer;

use Marvin255\Jwt\Signer\SecretString;
use Marvin255\Jwt\Test\BaseCase;

/**
 * @internal
 */
class SecretStringTest extends BaseCase
{
    public function testGetSecret(): void
    {
        $awaitedSecret = 'test_key';

        $secret = new SecretString($awaitedSecret);
        $secretString = $secret->getSecret();

        $this->assertSame($awaitedSecret, $secretString);
    }

    public function testGetPassPhrase(): void
    {
        $awaitedSecret = 'test_key';
        $awaitedPassPhrase = 'password';

        $secret = new SecretString($awaitedSecret, $awaitedPassPhrase);
        $passPhrase = $secret->getPassPhrase();

        $this->assertSame($awaitedPassPhrase, $passPhrase);
    }
}
