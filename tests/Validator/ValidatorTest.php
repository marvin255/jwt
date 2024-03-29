<?php

declare(strict_types=1);

namespace Marvin255\Jwt\Test\Validator;

use Marvin255\Jwt\Exception\JwtException;
use Marvin255\Jwt\Jwt;
use Marvin255\Jwt\Test\BaseCase;
use Marvin255\Jwt\Validator\Constraint;
use Marvin255\Jwt\Validator\Validator;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @internal
 */
class ValidatorTest extends BaseCase
{
    public function testWrongConstructorConstraintException(): void
    {
        $this->expectException(JwtException::class);
        new Validator(['test']);
    }

    public function testValidateDefault(): void
    {
        $token = $this->getTokenMock();
        $constraints = $this->createValidConstraintsForToken($token);

        $validator = new Validator($constraints);
        $response = $validator->validate($token);

        $this->assertTrue($response->isValid());
    }

    public function testDoesNotValidateDefault(): void
    {
        $token = $this->getTokenMock();
        $constraints = $this->createInvalidConstraintsForToken($token);

        $validator = new Validator($constraints);
        $response = $validator->validate($token);

        $this->assertFalse($response->isValid());
        $this->assertSame(['error'], $response->getErrors());
    }

    public function testValidate(): void
    {
        $token = $this->getTokenMock();
        $constraints = $this->createValidConstraintsForToken($token);

        $validator = new Validator();
        $response = $validator->validate($token, $constraints);

        $this->assertTrue($response->isValid());
    }

    public function testDoesNotValidate(): void
    {
        $token = $this->getTokenMock();
        $constraints = $this->createInvalidConstraintsForToken($token);

        $validator = new Validator();
        $response = $validator->validate($token, $constraints);

        $this->assertFalse($response->isValid());
        $this->assertSame(['error'], $response->getErrors());
    }

    public function testValidateSingleConstraint(): void
    {
        $token = $this->getTokenMock();
        /** @var Constraint&MockObject */
        $constraint = $this->getMockBuilder(Constraint::class)->getMock();
        $constraint->expects($this->once())
            ->method('checkToken')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn(true);
        $constraint->expects($this->never())->method('createErrorMessage');

        $validator = new Validator();
        $response = $validator->validate($token, $constraint);

        $this->assertTrue($response->isValid());
    }

    /**
     * @return Constraint[]
     */
    private function createValidConstraintsForToken(Jwt $token): array
    {
        /** @var Constraint&MockObject */
        $constraint = $this->getMockBuilder(Constraint::class)->getMock();
        $constraint->expects($this->once())
            ->method('checkToken')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn(true);
        $constraint->expects($this->never())->method('createErrorMessage');

        /** @var Constraint&MockObject */
        $constraint1 = $this->getMockBuilder(Constraint::class)->getMock();
        $constraint1->expects($this->once())
            ->method('checkToken')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn(true);
        $constraint1->expects($this->never())->method('createErrorMessage');

        return [$constraint, $constraint1];
    }

    /**
     * @return Constraint[]
     */
    private function createInvalidConstraintsForToken(Jwt $token): array
    {
        /** @var Constraint&MockObject */
        $constraint = $this->getMockBuilder(Constraint::class)->getMock();
        $constraint->expects($this->once())
            ->method('checkToken')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn(true);
        $constraint->expects($this->never())->method('createErrorMessage');

        /** @var Constraint&MockObject */
        $constraint1 = $this->getMockBuilder(Constraint::class)->getMock();
        $constraint1->expects($this->once())
            ->method('checkToken')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn(false);
        $constraint1->expects($this->once())
            ->method('createErrorMessage')
            ->with(
                $this->identicalTo($token)
            )
            ->willReturn('error');

        /** @var Constraint&MockObject */
        $constraint2 = $this->getMockBuilder(Constraint::class)->getMock();
        $constraint2->expects($this->never())->method('checkToken');

        return [$constraint, $constraint1, $constraint2];
    }
}
