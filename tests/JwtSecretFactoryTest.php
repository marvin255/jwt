<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test;

use Marvin255\Jwt\JwtSecretFactory;

/**
 * @internal
 */
class JwtSecretFactoryTest extends BaseCase
{
    public function testCreate(): void
    {
        $secret = 'tests';
        $passPhrase = 'test_pass';

        $res = JwtSecretFactory::create($secret, $passPhrase);
        $resSecret = $res->getSecret();
        $resPassPhrase = $res->getPassPhrase();

        $this->assertSame($secret, $resSecret);
        $this->assertSame($passPhrase, $resPassPhrase);
    }
}
