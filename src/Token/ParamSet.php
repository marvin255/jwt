<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

use Marvin255\Jwt\Exception\JwtException;

/**
 * Simple key/value storage for a list of params.
 */
abstract class ParamSet
{
    /**
     * @var array<string, mixed>
     */
    private array $params;

    /**
     * @param iterable $params
     *
     * @throws JwtException
     */
    public function __construct(iterable $params = [])
    {
        $this->params = [];
        foreach ($params as $paramName => $paramValue) {
            $this->params[(string) $paramName] = $paramValue;
        }
    }

    /**
     * Checks that set has param with set name.
     *
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool
    {
        return \array_key_exists($name, $this->params);
    }

    /**
     * Returns value by set param name.
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get(string $name, mixed $default = null): mixed
    {
        return \array_key_exists($name, $this->params)
            ? $this->params[$name]
            : $default;
    }

    /**
     * Returns all param as an associative array.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return $this->params;
    }

    /**
     * Returns named parameter as string or null if it doesn't exist.
     *
     * @param string $name
     *
     * @return string|null
     */
    protected function getOptionalString(string $name): ?string
    {
        return isset($this->params[$name])
            ? (string) $this->params[$name]
            : null;
    }

    /**
     * Returns named parameter as int or null if it doesn't exist.
     *
     * @param string $name
     *
     * @return int|null
     */
    protected function getOptionalInt(string $name): ?int
    {
        return isset($this->params[$name])
            ? (int) $this->params[$name]
            : null;
    }
}
