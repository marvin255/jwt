<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

/**
 * Object with response from validator.
 */
final class ValidationResult
{
    private readonly bool $isValid;

    /**
     * @var string[]
     */
    private readonly array $errors;

    /**
     * @param string[] $errors
     */
    public function __construct(bool $isValid, array $errors = [])
    {
        $this->isValid = $isValid;
        $this->errors = $errors;
    }

    /**
     * Returns true if token is valid.
     */
    public function isValid(): bool
    {
        return $this->isValid;
    }

    /**
     * Returns list of validation errors.
     *
     * @return string[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
