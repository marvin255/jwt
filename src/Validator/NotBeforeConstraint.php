<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;

/**
 * Constraint that checks that token can be used now.
 */
class NotBeforeConstraint implements Constraint
{
    private int $leeway;

    public function __construct(int $leeway = 0)
    {
        $this->leeway = $leeway;
    }

    /**
     * {@inheritDoc}
     */
    public function checkToken(Jwt $token): bool
    {
        $nbfHeader = $token->claims()->getNbf();

        if ($nbfHeader === null) {
            return true;
        }

        return $nbfHeader <= (time() + $this->leeway);
    }

    /**
     * {@inheritDoc}
     */
    public function createErrorMessage(Jwt $token): string
    {
        return 'Token is nor allowed to use yet. Need wait for some time.';
    }
}
