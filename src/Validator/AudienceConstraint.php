<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Jwt;

/**
 * Constraint that checks that token can be used by this client.
 */
final class AudienceConstraint implements Constraint
{
    public function __construct(private readonly string $awaitedAudience)
    {
    }

    /**
     * {@inheritDoc}
     */
    public function checkToken(Jwt $token): bool
    {
        $audHeader = $token->claims()->aud();

        if (!$audHeader->isPresent()) {
            return false;
        }

        $value = $audHeader->get();

        if (\is_array($value)) {
            return \in_array($this->awaitedAudience, $value, true);
        }

        return $value === $this->awaitedAudience;
    }

    /**
     * {@inheritDoc}
     */
    public function createErrorMessage(Jwt $token): string
    {
        return 'This token was issued for other recepient.';
    }
}
