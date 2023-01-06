<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Helper;

/**
 * Helper with base64 encode and decode methods.
 *
 * @internal
 */
final class Base64
{
    private function __construct()
    {
    }

    /**
     * Encodes string as base64 url.
     */
    public static function urlEncode(string $data): string
    {
        $encoded = base64_encode($data);
        $encoded = strtr($encoded, '+/', '-_');

        return rtrim($encoded, '=');
    }

    /**
     * Decodes string from base64 url.
     */
    public static function urlDecode(string $data): string
    {
        $decoded = str_replace(
            ['-', '_'],
            ['+', '/'],
            $data
        );

        return base64_decode($decoded);
    }

    /**
     * Encodes array to base64 string.
     */
    public static function arrayEncode(array $data): string
    {
        $json = json_encode($data, \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE | \JSON_THROW_ON_ERROR);

        return self::urlEncode($json);
    }

    /**
     * Decodes array from base64 string.
     */
    public static function arrayDecode(string $data): array
    {
        $json = self::urlDecode($data);

        return (array) json_decode($json, true, 512, \JSON_THROW_ON_ERROR);
    }
}
