<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Token;

use Marvin255\Optional\Optional;

/**
 * Simple key/value storage for a list of params.
 *
 * @internal
 */
abstract class ParamSet
{
    /**
     * @var array<string, mixed>
     */
    private readonly array $params;

    public function __construct(iterable $params = [])
    {
        $setParams = [];
        foreach ($params as $paramName => $paramValue) {
            if ($paramValue !== null && \is_string($paramName)) {
                $setParams[$paramName] = $paramValue;
            }
        }
        $this->params = $setParams;
    }

    /**
     * Returns value by set param name.
     *
     * @return Optional<mixed>
     */
    public function param(string $name): Optional
    {
        $value = $this->params[$name] ?? null;

        return Optional::ofNullable($value);
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
     * Returns named parameter as string.
     *
     * @return Optional<string>
     */
    protected function getOptionalString(string $name): Optional
    {
        /** @var Optional<string> */
        $optional = isset($this->params[$name])
            ? Optional::of((string) $this->params[$name])
            : Optional::empty();

        return $optional;
    }

    /**
     * Returns named parameter as int.
     *
     * @return Optional<int>
     */
    protected function getOptionalInt(string $name): Optional
    {
        /** @var Optional<int> */
        $optional = isset($this->params[$name])
            ? Optional::of((int) $this->params[$name])
            : Optional::empty();

        return $optional;
    }

    /**
     * Returns named parameter as array.
     *
     * @return Optional<array>
     */
    protected function getOptionalArray(string $name): Optional
    {
        /** @var Optional<array> */
        $optional = isset($this->params[$name]) && \is_array($this->params[$name])
            ? Optional::of($this->params[$name])
            : Optional::empty();

        return $optional;
    }
}
