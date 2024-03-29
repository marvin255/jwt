<?php

declare(strict_types=1);

namespace Marvin255\Jwt;

use Marvin255\Jwt\Token\ClaimSet;
use Marvin255\Jwt\Token\JoseHeader;
use Marvin255\Jwt\Token\Signature;

/**
 * Interface for jwt object.
 */
interface Jwt
{
    /**
     * Returns JOSE header related to this token.
     */
    public function jose(): JoseHeader;

    /**
     * Returns claims set related to this token.
     */
    public function claims(): ClaimSet;

    /**
     * Returns signature related to this token.
     */
    public function signature(): Signature;
}
