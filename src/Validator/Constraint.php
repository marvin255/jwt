<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;

/**
 * Interface for object that represents single validation constraint.
 */
interface Constraint
{
    /**
     * Checks that token is valid for this constaint.
     *
     * @param Jwt $token
     *
     * @return bool
     */
    public function checkToken(Jwt $token): bool;

    /**
     * Creates error message for set token.
     *
     * @param Jwt $token
     *
     * @return string
     */
    public function createErrorMessage(Jwt $token): string;
}
