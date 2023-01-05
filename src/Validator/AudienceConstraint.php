<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;

/**
 * Constraint that checks that token can be used by this client.
 */
final class AudienceConstraint implements Constraint
{
    private readonly string $awaitedAudience;

    public function __construct(string $awaitedAudience)
    {
        $this->awaitedAudience = $awaitedAudience;
    }

    /**
     * {@inheritDoc}
     */
    public function checkToken(Jwt $token): bool
    {
        $audHeader = $token->claims()->getAud();

        if (empty($audHeader)) {
            return false;
        }

        if (\is_array($audHeader)) {
            return \in_array($this->awaitedAudience, $audHeader, true);
        }

        return $audHeader === $this->awaitedAudience;
    }

    /**
     * {@inheritDoc}
     */
    public function createErrorMessage(Jwt $token): string
    {
        return 'This token was issued for other recepient.';
    }
}
