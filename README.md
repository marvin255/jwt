# JWT

[![Build Status](https://github.com/marvin255/jwt/workflows/marvin255_jwt/badge.svg)](https://github.com/marvin255/jwt/actions?query=workflow%3A%22marvin255_jwt%22)

Simple [JWT](https://tools.ietf.org/html/rfc7519) implementation for PHP.



## Installation

Install package via composer

```shell
composer req marvin255/jwt
```



## Parse token from header

```php
use Marvin255\Jwt\JwtFactory;

$token = JwtFactory::decoder()->decodeHeader($_SERVER['HTTP_AUTHORIZE']);
```



## Validate token

```php
use Marvin255\Jwt\JwtFactory;
use Marvin255\Jwt\Signer\SecretFile;
use Marvin255\Jwt\Signer\RsaSha512Signer;
use Marvin255\Jwt\Validator\ExpirationConstraint;
use Marvin255\Jwt\Validator\NotBeforeConstraint;
use Marvin255\Jwt\Validator\AudienceConstraint;
use Marvin255\Jwt\Validator\SignatureConstraint;

$publicKey = new SecretFile('path/to/public.key');
$privateKey = new SecretFile('path/to/private.key');
$signer = new RsaSha512Signer($publicKey, $privateKey);

$constraints = [
    new ExpirationConstraint(3),          // checks that token is not expired with 3s leeway
    new NotBeforeConstraint(3),           // checks nbf header with 3s leeway
    new AudienceConstraint('my_service'), // checks that token was issued for this service
    new SignatureConstraint($signer),     // checks signature
];

$res = JwtFactory::validator()->validate($token, $constraints);
if ($res->isValid()) {
    echo "token is valid";
} else {
    var_dump($res->getErrors());
}
```



## Retrieve data from token

```php
// jose params
$alg = $token->jose()->getAlg();                   // registered JOSE params have own getters
$customParam = $token->jose()->get('custom_jose'); // any custom JOSE param from the payload

// claims
$iss = $token->claims()->getIss();                    // registered claims have own getters
$customClaim = $token->claims()->get('custom_claim'); // any custom claim from the payload
```



## Create new token

```php
use Marvin255\Jwt\JwtFactory;
use Marvin255\Jwt\Signer\SecretFile;
use Marvin255\Jwt\Signer\RsaSha512Signer;

$publicKey = new SecretFile('path/to/public.key');
$privateKey = new SecretFile('path/to/private.key');
$signer = new RsaSha512Signer($publicKey, $privateKey);

$token = JwtFactory::builder()
    ->setJoseParam('test', 'test') // any custom JOSE param
    ->setIss('test')               // registered claims have own setters
    ->setClaim('test', 'test')     // any custom claim
    ->signWith($signer)            // signer
    ->create()
;
```



## Encode token to string

```php
use Marvin255\Jwt\JwtFactory;

$tokenString = JwtFactory::encoder()->encode($token);
```
