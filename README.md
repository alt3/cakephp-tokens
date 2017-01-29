# cakephp-tokens

[![Build Status](https://img.shields.io/travis/alt3/cakephp-tokens/master.svg?style=flat-square)](https://travis-ci.org/alt3/cakephp-tokens)
[![StyleCI Status](https://styleci.io/repos/80351778/shield)](https://styleci.io/repos/80351778)
[![Coverage Status](https://img.shields.io/codecov/c/github/alt3/cakephp-tokens/master.svg?style=flat-square)](https://codecov.io/github/alt3/cakephp-tokens)
[![Total Downloads](https://img.shields.io/packagist/dt/alt3/cakephp-tokens.svg?style=flat-square)](https://packagist.org/packages/alt3/cakephp-tokens)
[![License](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](LICENSE.txt)

CakePHP plugin for generating various (secure) tokens.

## Requirements

* CakePHP 3.0+

## Installation

1. Install the plugin using composer:

    ```bash
    composer require alt3/cakephp-tokens:1.0.x-dev
    ```

2. To enable the plugin either run the following command:

    ```bash
    bin/cake plugin load Alt3/CakeTokens
    ```

    or manually add the following line to your `config/bootstrap.php` file:

    ```php
    Plugin::load('Alt3/CakeTokens');
    ```

3. Create the required table used to store the tokens by running:

    ```bash
    bin/cake migrations migrate --plugin Alt3/CakeTokens
    ```

## Usage

Inside your controller:

```php
use Alt3\Tokens\RandomBytesAdapter

public function test() {

  // create the token object
  $token = new RandomBytesToken();
  $token->setCategory('password-reset');
  $token->setLifetime('+1 week');

  // save the token object
  $table = TableRegistry::get('Alt3/CakeTokens.Tokens');
  $entity = $table->newEntity($token->toArray());
  
  if ($table->save($entity)) {
    pr('Successfully saved token with id ' . $entity->id);
  }
}
```

> Visit [alt3/tokens](https://github.com/alt3/tokens) for more information
> about creating the token object and creating your own
> token-specific Adapters.

## Methods

The `TokensTable` comes with the following methods:

- `setStatus($id, $status)`: set the status for token with id
- `deleteAllExpired()`: deletes all tokens that have expires
- `deleteAllWithStatus($status)`: deletes all tokens matching given status

## Custom Finders

The `TokensTable` comes with the following custom finders:

- `findValidToken`: true when given token value (must be passed)exists, has status 0 and has not expired
- `findAllActive`: returns all tokens with status 0

## Contribute

Before submitting a PR make sure:

- [PHPUnit](http://book.cakephp.org/3.0/en/development/testing.html#running-tests)
tests pass (`composer run-script tests`)
- [PSR-2 Code Sniffer](https://github.com/squizlabs/PHP_CodeSniffer)
 tests pass (`composer run-script cs`)
- [Coveralls Code Coverage ](https://coveralls.io/github/alt3/cakephp-tokens) remains at 100%
