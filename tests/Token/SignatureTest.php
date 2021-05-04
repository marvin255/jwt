<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Token;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\Signature;

/**
 * @internal
 */
class SignatureTest extends BaseCase
{
    public function testGetSignatureString(): void
    {
        $signatureString = 'test';

        $signature = new Signature($signatureString);
        $gotSignature = $signature->getSignatureString();

        $this->assertSame($signatureString, $gotSignature);
    }
}
