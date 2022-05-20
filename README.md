# toncenter-php-sdk
PHP SDK for toncenter

![tests](https://github.com/jeyroik/toncenter-php-sdk/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/toncenter-php-sdk/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a> 
<a href="https://codeclimate.com/github/jeyroik/toncenter-php-sdk/maintainability"><img src="https://api.codeclimate.com/v1/badges/ec3578c5a44df50d3317/maintainability" /></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/toncenter-php-sdk/v)](//packagist.org/packages/jeyroik/toncenter-php-sdk)
[![Total Downloads](https://poser.pugx.org/jeyroik/toncenter-php-sdk/downloads)](//packagist.org/packages/jeyroik/toncenter-php-sdk)
[![Dependents](https://poser.pugx.org/jeyroik/toncenter-php-sdk/dependents)](//packagist.org/packages/jeyroik/toncenter-php-sdk)


# usage

```php
$address = new Address([Address::FIELD__HASH => 'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0Yr']);
$address->loadInformation();

echo $address->getBalance(); // 15684203405
echo $address->getBalanceAsToncoins(); // 15,684203405

echo $address->getLastTransation()->getHash();
```