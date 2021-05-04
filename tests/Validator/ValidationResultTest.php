<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Validator;

use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Validator\ValidationResult;

/**
 * @internal
 */
class ValidationResultTest extends BaseCase
{
    public function testIsValid(): void
    {
        $isValid = true;

        $result = new ValidationResult($isValid);

        $this->assertTrue($result->isValid());
    }

    public function testIsNotValid(): void
    {
        $isValid = false;

        $result = new ValidationResult($isValid);

        $this->assertFalse($result->isValid());
    }

    public function testGetErrors(): void
    {
        $isValid = false;
        $errors = ['test', 'test 1'];

        $result = new ValidationResult($isValid, $errors);

        $this->assertSame($errors, $result->getErrors());
    }
}
