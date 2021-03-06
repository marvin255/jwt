<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

/**
 * Object with response from validator.
 */
class ValidationResult
{
    private bool $isValid;

    /**
     * @var string[]
     */
    private array $errors;

    /**
     * @param bool     $isValid
     * @param string[] $errors
     */
    public function __construct(bool $isValid, array $errors = [])
    {
        $this->isValid = $isValid;
        $this->errors = $errors;
    }

    /**
     * Returns true if token is valid.
     *
     * @return bool
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
