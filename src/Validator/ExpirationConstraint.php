<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;

/**
 * Constraint that checks that token is not expired.
 */
final class ExpirationConstraint implements Constraint
{
    public const DEFAULT_LEEWAY = 0;

    private readonly int $leeway;

    public function __construct(int $leeway = self::DEFAULT_LEEWAY)
    {
        if ($leeway < 0) {
            throw new \InvalidArgumentException("Leeway can't be negative");
        }

        $this->leeway = $leeway;
    }

    /**
     * {@inheritDoc}
     */
    public function checkToken(Jwt $token): bool
    {
        $expHeader = $token->claims()->exp();

        if (!$expHeader->isPresent()) {
            return true;
        }

        return $expHeader->get() >= (time() - $this->leeway);
    }

    /**
     * {@inheritDoc}
     */
    public function createErrorMessage(Jwt $token): string
    {
        return 'Token is expired.';
    }
}
