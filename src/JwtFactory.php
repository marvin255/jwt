<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Builder\Builder;
use Marvin255\Jwt\Decoder\Decoder;
use Marvin255\Jwt\Encoder\Encoder;
use Marvin255\Jwt\Validator\Validator;

/**
 * Factory object for JWT.
 */
final class JwtFactory
{
    private static ?JwtDecoder $decoder = null;

    private static ?JwtEncoder $encoder = null;

    private static ?JwtValidator $validator = null;

    private function __construct()
    {
    }

    /**
     * Creates and returns decoder object.
     */
    public static function decoder(): JwtDecoder
    {
        if (self::$decoder === null) {
            self::$decoder = new Decoder(self::builder());
        }

        return self::$decoder;
    }

    /**
     * Creates and returns encoder object.
     */
    public static function encoder(): JwtEncoder
    {
        if (self::$encoder === null) {
            self::$encoder = new Encoder();
        }

        return self::$encoder;
    }

    /**
     * Creates and returns encoder object.
     */
    public static function validator(): JwtValidator
    {
        if (self::$validator === null) {
            self::$validator = new Validator();
        }

        return self::$validator;
    }

    /**
     * Creates and returns builder object.
     */
    public static function builder(): JwtBuilder
    {
        return new Builder();
    }
}
