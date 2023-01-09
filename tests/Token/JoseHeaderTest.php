<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Token;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Token\JoseHeader;
use Marvin255\Jwt\Token\JoseHeaderParams;
use Marvin255\Optional\NoSuchElementException;

/**
 * @internal
 */
class JoseHeaderTest extends BaseCase
{
    /**
     * @dataProvider provideJoseGetter
     *
     * @psalm-suppress MixedMethodCall
     */
    public function testJoseGetter(array $set, string $getter, mixed $result): void
    {
        $jose = new JoseHeader($set);

        if ($result instanceof \Exception) {
            $this->expectException(\get_class($result));
        }

        $testResult = $jose->$getter()->get();

        $this->assertSame($result, $testResult);
    }

    public function provideJoseGetter(): array
    {
        $value = 'test';

        return [
            JoseHeaderParams::TYP->value => [
                [JoseHeaderParams::TYP->value => $value],
                JoseHeaderParams::TYP->value,
                $value,
            ],
            JoseHeaderParams::TYP->value . ' int value' => [
                [JoseHeaderParams::TYP->value => 123],
                JoseHeaderParams::TYP->value,
                '123',
            ],
            JoseHeaderParams::TYP->value . ' not defined' => [
                [],
                JoseHeaderParams::TYP->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::CTY->value => [
                [JoseHeaderParams::CTY->value => $value],
                JoseHeaderParams::CTY->value,
                $value,
            ],
            JoseHeaderParams::CTY->value . ' not defined' => [
                [],
                JoseHeaderParams::CTY->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::ALG->value => [
                [JoseHeaderParams::ALG->value => $value],
                JoseHeaderParams::ALG->value,
                $value,
            ],
            JoseHeaderParams::ALG->value . ' not defined' => [
                [],
                JoseHeaderParams::ALG->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::JKU->value => [
                [JoseHeaderParams::JKU->value => $value],
                JoseHeaderParams::JKU->value,
                $value,
            ],
            JoseHeaderParams::JKU->value . ' not defined' => [
                [],
                JoseHeaderParams::JKU->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::JWK->value => [
                [JoseHeaderParams::JWK->value => $value],
                JoseHeaderParams::JWK->value,
                $value,
            ],
            JoseHeaderParams::JWK->value . ' not defined' => [
                [],
                JoseHeaderParams::JWK->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::KID->value => [
                [JoseHeaderParams::KID->value => $value],
                JoseHeaderParams::KID->value,
                $value,
            ],
            JoseHeaderParams::KID->value . ' not defined' => [
                [],
                JoseHeaderParams::KID->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::X5U->value => [
                [JoseHeaderParams::X5U->value => $value],
                JoseHeaderParams::X5U->value,
                $value,
            ],
            JoseHeaderParams::X5U->value . ' not defined' => [
                [],
                JoseHeaderParams::X5U->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::X5C->value => [
                [JoseHeaderParams::X5C->value => $value],
                JoseHeaderParams::X5C->value,
                $value,
            ],
            JoseHeaderParams::X5C->value . ' not defined' => [
                [],
                JoseHeaderParams::X5C->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::X5T->value => [
                [JoseHeaderParams::X5T->value => $value],
                JoseHeaderParams::X5T->value,
                $value,
            ],
            JoseHeaderParams::X5T->value . ' not defined' => [
                [],
                JoseHeaderParams::X5T->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::X5T256->value => [
                [JoseHeaderParams::X5T256->value => $value],
                'x5t256',
                $value,
            ],
            JoseHeaderParams::X5T256->value . ' not defined' => [
                [],
                'x5t256',
                new NoSuchElementException(),
            ],
            JoseHeaderParams::CRIT->value => [
                [JoseHeaderParams::CRIT->value => ['param' => 'value']],
                JoseHeaderParams::CRIT->value,
                ['param' => 'value'],
            ],
            JoseHeaderParams::CRIT->value . ' not an array value' => [
                [JoseHeaderParams::CRIT->value => 'test'],
                JoseHeaderParams::CRIT->value,
                new NoSuchElementException(),
            ],
            JoseHeaderParams::CRIT->value . ' not defined' => [
                [],
                JoseHeaderParams::CRIT->value,
                new NoSuchElementException(),
            ],
        ];
    }

    /**
     * @dataProvider provideParam
     */
    public function testParam(array $set, string $name, mixed $result): void
    {
        $jose = new JoseHeader($set);

        if ($result instanceof \Exception) {
            $this->expectException(\get_class($result));
        }

        $testResult = $jose->param($name)->get();

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

        $jose = new JoseHeader($set);
        $testSet = $jose->toArray();

        $this->assertSame($resultSet, $testSet);
    }
}
