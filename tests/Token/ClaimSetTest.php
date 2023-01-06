<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Token;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\ClaimSet;

/**
 * @internal
 */
class ClaimSetTest extends BaseCase
{
    public function testHas(): void
    {
        $claim = 'claim';
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);

        $this->assertTrue($claimSet->has($claim));
    }

    public function testHasNull(): void
    {
        $claim = 'claim';
        $claimValue = null;
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);

        $this->assertTrue($claimSet->has($claim));
    }

    public function testDoesntHave(): void
    {
        $claim = 'claim';
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);

        $this->assertFalse($claimSet->has('unexisted'));
    }

    public function testGet(): void
    {
        $claim = 'claim';
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->get($claim)->get();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testToArray(): void
    {
        $claim = 'claim';
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $array = $claimSet->toArray();

        $this->assertSame($paramSet, $array);
    }

    public function testGetIss(): void
    {
        $claim = ClaimSet::ISS;
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getIss();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testGetIssNull(): void
    {
        $claim = 'test';
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getIss();

        $this->assertNull($gotClaim);
    }

    public function testGetSub(): void
    {
        $claim = ClaimSet::SUB;
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getSub();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testGetSubNull(): void
    {
        $claim = 'test';
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getSub();

        $this->assertNull($gotClaim);
    }

    public function testGetAud(): void
    {
        $claim = ClaimSet::AUD;
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getAud();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testGetAudNull(): void
    {
        $claim = 'test';
        $claimValue = 'claim_value';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getAud();

        $this->assertNull($gotClaim);
    }

    public function testGetExp(): void
    {
        $claim = ClaimSet::EXP;
        $claimValue = 123;
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getExp();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testGetExpNull(): void
    {
        $claim = 'test';
        $claimValue = 123;
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getExp();

        $this->assertNull($gotClaim);
    }

    public function testGetNbf(): void
    {
        $claim = ClaimSet::NBF;
        $claimValue = 123;
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getNbf();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testGetNbfNull(): void
    {
        $claim = 'test';
        $claimValue = 123;
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getNbf();

        $this->assertNull($gotClaim);
    }

    public function testGetIat(): void
    {
        $claim = ClaimSet::IAT;
        $claimValue = 123;
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getIat();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testGetIatNull(): void
    {
        $claim = 'test';
        $claimValue = 123;
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getIat();

        $this->assertNull($gotClaim);
    }

    public function testGetJti(): void
    {
        $claim = ClaimSet::JTI;
        $claimValue = 'test';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getJti();

        $this->assertSame($claimValue, $gotClaim);
    }

    public function testGetJtiNull(): void
    {
        $claim = 'test';
        $claimValue = 'test';
        $paramSet = [$claim => $claimValue];

        $claimSet = new ClaimSet($paramSet);
        $gotClaim = $claimSet->getJti();

        $this->assertNull($gotClaim);
    }
}
