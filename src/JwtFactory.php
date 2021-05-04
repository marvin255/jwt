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
class JwtFactory
{
    private static ?JwtDecoder $decoder = null;

    private static ?JwtEncoder $encoder = null;

    private static ?JwtValidator $validator = null;

    /**
     * Creates and returns decoder object.
     *
     * @return JwtDecoder
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
     *
     * @return JwtEncoder
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
     *
     * @return JwtValidator
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
     *
     * @return JwtBuilder
     */
    public static function builder(): JwtBuilder
    {
        return new Builder();
    }
}
