<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Validator;

use Marvin255\Jwt\Exception\JwtException;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\JwtValidator;

/**
 * Basic validator object.
 */
final class Validator implements JwtValidator
{
    /**
     * @var Constraint[]
     */
    private readonly array $defaultConstraints;

    public function __construct(iterable $defaultConstraints = [])
    {
        $constraints = [];
        foreach ($defaultConstraints as $defaultConstraint) {
            if (!($defaultConstraint instanceof Constraint)) {
                throw new JwtException(\sprintf("Constraint item must be instance of '%s'", Constraint::class));
            }
            $constraints[] = $defaultConstraint;
        }
        $this->defaultConstraints = $constraints;
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function validate(Jwt $token, Constraint|array|null $constraints = null): ValidationResult
    {
        $constraintsForValidation = $this->defineConstraintsList($constraints);

        $isValid = true;
        $errors = [];
        foreach ($constraintsForValidation as $constraint) {
            if (!$constraint->checkToken($token)) {
                $isValid = false;
                $errors[] = $constraint->createErrorMessage($token);
                break;
            }
        }

        return new ValidationResult($isValid, $errors);
    }

    /**
     * Prepares list of constraints for current validation.
     *
     * @param Constraint|Constraint[]|null $constraints
     *
     * @return Constraint[]
     */
    private function defineConstraintsList(Constraint|array|null $constraints): array
    {
        if ($constraints === null) {
            return $this->defaultConstraints;
        }

        return $constraints instanceof Constraint ? [$constraints] : $constraints;
    }
}
