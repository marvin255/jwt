<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;

/**
 * Constraint that checks that token is not expired.
 */
final class ExpirationConstraint implements Constraint
{
    private readonly int $leeway;

    public function __construct(int $leeway = 0)
    {
        $this->leeway = $leeway;
    }

    /**
     * {@inheritDoc}
     */
    public function checkToken(Jwt $token): bool
    {
        $expHeader = $token->claims()->getExp();

        if ($expHeader === null) {
            return true;
        }

        return $expHeader >= (time() - $this->leeway);
    }

    /**
     * {@inheritDoc}
     */
    public function createErrorMessage(Jwt $token): string
    {
        return 'Token is expired.';
    }
}
