<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test;

use Marvin255\Jwt\JwtBuilder;
use Marvin255\Jwt\JwtDecoder;
use Marvin255\Jwt\JwtEncoder;
use Marvin255\Jwt\JwtFactory;
use Marvin255\Jwt\JwtValidator;

/**
 * @internal
 */
class JwtFactoryTest extends BaseCase
{
    public function testDecoder(): void
    {
        $decoder = JwtFactory::decoder();

        $this->assertInstanceOf(JwtDecoder::class, $decoder);
    }

    public function testValidator(): void
    {
        $validator = JwtFactory::validator();

        $this->assertInstanceOf(JwtValidator::class, $validator);
    }

    public function testBuilder(): void
    {
        $builder = JwtFactory::builder();

        $this->assertInstanceOf(JwtBuilder::class, $builder);
    }

    public function testEncoder(): void
    {
        $encoder = JwtFactory::encoder();

        $this->assertInstanceOf(JwtEncoder::class, $encoder);
    }
}
