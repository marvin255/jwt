<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;

/**
 * Constraint that checks that token can be used now.
 */
final class NotBeforeConstraint implements Constraint
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
        $nbfHeader = $token->claims()->nbf();

        if (!$nbfHeader->isPresent()) {
            return true;
        }

        return $nbfHeader->get() <= (time() + $this->leeway);
    }

    /**
     * {@inheritDoc}
     */
    public function createErrorMessage(Jwt $token): string
    {
        return 'Token is nor allowed to use yet. Need wait for some time.';
    }
}
