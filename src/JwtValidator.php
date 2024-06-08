<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Validator\Constraint;
use Marvin255\Jwt\Validator\ValidationResult;

/**
 * Interface for object that can validate token params.
 */
interface JwtValidator
{
    /**
     * Validates token against set sonstraints.
     *
     * @param Constraint|Constraint[]|null $constraints
     */
    public function validate(Jwt $token, Constraint|array|null $constraints = null): ValidationResult;
}
