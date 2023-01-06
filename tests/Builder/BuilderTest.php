<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Token;

use Marvin255\Jwt\Builder\Builder;
use Marvin255\Jwt\JwtSigner;
use Marvin255\Jwt\Test\BaseCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
class BuilderTest extends BaseCase
{
    public function testSetJoseParam(): void
    {
        $jose = 'test';
        $joseValue = 'test_value';

        $builder = new Builder();
        $builder->setJoseParam($jose, $joseValue);
        $token = $builder->build();

        $this->assertSame(
            $joseValue,
            $token->jose()->param($jose)->get()
        );
    }

    public function testSetJoseParams(): void
    {
        $jose = 'test';
        $joseValue = 'test_value';

        $builder = new Builder();
        $builder->setJoseParams([$jose => $joseValue]);
        $token = $builder->build();

        $this->assertSame(
            $joseValue,
            $token->jose()->param($jose)->get()
        );
    }

    public function testSetClaim(): void
    {
        $claim = 'test';
        $claimValue = 'test_value';

        $builder = new Builder();
        $builder->setClaim($claim, $claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->param($claim)->get()
        );
    }

    public function testSetClaims(): void
    {
        $claim = 'test';
        $claimValue = 'test_value';

        $builder = new Builder();
        $builder->setClaims([$claim => $claimValue]);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->param($claim)->get()
        );
    }

    public function testSetIss(): void
    {
        $claimValue = 'test_value';

        $builder = new Builder();
        $builder->setIss($claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->iss()->get()
        );
    }

    public function testSetSub(): void
    {
        $claimValue = 'test_value';

        $builder = new Builder();
        $builder->setSub($claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->sub()->get()
        );
    }

    public function testSetAud(): void
    {
        $claimValue = 'test_value';

        $builder = new Builder();
        $builder->setAud($claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->aud()->get()
        );
    }

    public function testSetExp(): void
    {
        $claimValue = 10000;

        $builder = new Builder();
        $builder->setExp($claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->exp()->get()
        );
    }

    public function testSetNbf(): void
    {
        $claimValue = 10000;

        $builder = new Builder();
        $builder->setNbf($claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->nbf()->get()
        );
    }

    public function testSetIat(): void
    {
        $claimValue = 10000;

        $builder = new Builder();
        $builder->setIat($claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->iat()->get()
        );
    }

    public function testSetJti(): void
    {
        $claimValue = 'test';

        $builder = new Builder();
        $builder->setJti($claimValue);
        $token = $builder->build();

        $this->assertSame(
            $claimValue,
            $token->claims()->jti()->get()
        );
    }

    public function testSetSignature(): void
    {
        $signature = 'test';

        $builder = new Builder();
        $builder->setSignature($signature);
        $token = $builder->build();

        $this->assertSame(
            $signature,
            $token->signature()->getSignatureString()
        );
    }

    public function testSignWith(): void
    {
        $jose = 'test';
        $joseValue = 'test_value';
        $joseAlg = 'alg';
        $joseAlgValue = 'alg_value';
        $joseArray = [$jose => $joseValue];
        $joseArrayWithAlg = [$jose => $joseValue, $joseAlg => $joseAlgValue];

        $claim = 'claim';
        $claimValue = 'claim_value';
        $claims = [$claim => $claimValue];

        $signature = 'signature';

        /** @var MockObject&JwtSigner */
        $signer = $this->getMockBuilder(JwtSigner::class)->getMock();
        $signer->method('updateJoseParams')
            ->with(
                $this->equalTo($joseArray)
            )
            ->willReturn($joseArrayWithAlg)
        ;
        $signer->method('createSignature')
            ->with(
                $this->equalTo($joseArrayWithAlg),
                $this->equalTo($claims)
            )
            ->willReturn($signature)
        ;

        $builder = new Builder();
        $builder->signWith($signer);
        $builder->setClaim($claim, $claimValue);
        $builder->setJoseParam($jose, $joseValue);
        $token = $builder->build();

        $this->assertSame(
            $signature,
            $token->signature()->getSignatureString()
        );
        $this->assertSame(
            $joseValue,
            $token->jose()->param($jose)->get()
        );
    }
}
