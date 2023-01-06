<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Token;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\ClaimSet;
use Marvin255\Jwt\Token\ClaimSetParams;
use Marvin255\Optional\NoSuchElementException;

/**
 * @internal
 */
class ClaimSetTest extends BaseCase
{
    /**
     * @dataProvider provideClaimSetGetter
     *
     * @psalm-suppress MixedMethodCall
     */
    public function testClaimSetGetter(array $set, string $getter, mixed $result): void
    {
        $claimSet = new ClaimSet($set);

        if ($result instanceof \Exception) {
            $this->expectException(\get_class($result));
        }

        $testResult = $claimSet->$getter()->get();

        $this->assertSame($result, $testResult);
    }

    public function provideClaimSetGetter(): array
    {
        $valueString = 'test';
        $valueInt = 123;

        return [
            ClaimSetParams::ISS->value => [
                [ClaimSetParams::ISS->value => $valueString],
                ClaimSetParams::ISS->value,
                $valueString,
            ],
            ClaimSetParams::ISS->value . ' not defined' => [
                [],
                ClaimSetParams::ISS->value,
                new NoSuchElementException(),
            ],
            ClaimSetParams::SUB->value => [
                [ClaimSetParams::SUB->value => $valueString],
                ClaimSetParams::SUB->value,
                $valueString,
            ],
            ClaimSetParams::SUB->value . ' not defined' => [
                [],
                ClaimSetParams::SUB->value,
                new NoSuchElementException(),
            ],
            ClaimSetParams::AUD->value => [
                [ClaimSetParams::AUD->value => $valueString],
                ClaimSetParams::AUD->value,
                $valueString,
            ],
            ClaimSetParams::AUD->value . ' not defined' => [
                [],
                ClaimSetParams::AUD->value,
                new NoSuchElementException(),
            ],
            ClaimSetParams::EXP->value => [
                [ClaimSetParams::EXP->value => $valueInt],
                ClaimSetParams::EXP->value,
                $valueInt,
            ],
            ClaimSetParams::EXP->value . ' not defined' => [
                [],
                ClaimSetParams::EXP->value,
                new NoSuchElementException(),
            ],
            ClaimSetParams::NBF->value => [
                [ClaimSetParams::NBF->value => $valueInt],
                ClaimSetParams::NBF->value,
                $valueInt,
            ],
            ClaimSetParams::NBF->value . ' not defined' => [
                [],
                ClaimSetParams::NBF->value,
                new NoSuchElementException(),
            ],
            ClaimSetParams::IAT->value => [
                [ClaimSetParams::IAT->value => $valueInt],
                ClaimSetParams::IAT->value,
                $valueInt,
            ],
            ClaimSetParams::IAT->value . ' not defined' => [
                [],
                ClaimSetParams::IAT->value,
                new NoSuchElementException(),
            ],
            ClaimSetParams::JTI->value => [
                [ClaimSetParams::JTI->value => $valueString],
                ClaimSetParams::JTI->value,
                $valueString,
            ],
            ClaimSetParams::JTI->value . ' not defined' => [
                [],
                ClaimSetParams::JTI->value,
                new NoSuchElementException(),
            ],
        ];
    }

    /**
     * @dataProvider provideParam
     */
    public function testParam(array $set, string $name, mixed $result): void
    {
        $claimSet = new ClaimSet($set);

        if ($result instanceof \Exception) {
            $this->expectException(\get_class($result));
        }

        $testResult = $claimSet->param($name)->get();

        $this->assertSame($result, $testResult);
    }

    public function provideParam(): array
    {
        $name = 'param_name';
        $value = 'param_value';

        return [
            'has param' => [
                [$name => $value],
                $name,
                $value,
            ],
            "doesn't have param" => [
                [],
                $name,
                new NoSuchElementException(),
            ],
            'null value' => [
                [$name => null],
                $name,
                new NoSuchElementException(),
            ],
        ];
    }

    public function testToArray(): void
    {
        $set = [
            'param1' => 'value1',
            'param2' => 'value2',
            'param3' => null,
        ];
        $resultSet = [
            'param1' => 'value1',
            'param2' => 'value2',
        ];

        $jose = new ClaimSet($set);
        $testSet = $jose->toArray();

        $this->assertSame($resultSet, $testSet);
    }
}
