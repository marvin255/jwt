<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test;

use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\Token\ClaimSet;
use Marvin255\Jwt\Token\JoseHeader;
use Marvin255\Jwt\Token\Signature;
use Marvin255\Jwt\Token\Token;
use PHPUnit\Framework\TestCase;

abstract class BaseCase extends TestCase
{
    protected function getJoseHeaderMock(array $paramsSet = []): JoseHeader
    {
        return new JoseHeader($paramsSet);
    }

    protected function getClaimSetMock(array $claims = []): ClaimSet
    {
        return new ClaimSet($claims);
    }

    protected function getSignatureMock(string $signature = 'test'): Signature
    {
        return new Signature($signature);
    }

    protected function getTokenMock(array $params = [], array $claims = [], string $signatureString = ''): Jwt
    {
        $jose = $this->getJoseHeaderMock($params);
        $claimSet = $this->getClaimSetMock($claims);
        $signature = $this->getSignatureMock($signatureString);

        return new Token($jose, $claimSet, $signature);
    }
}
