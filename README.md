# toncenter-php-sdk

PHP SDK for toncenter

SDK allow to work with https://toncenter.com/api/v2/

![tests](https://github.com/jeyroik/toncenter-php-sdk/workflows/PHP%20Composer/badge.svg?branch=master&event=push)
![codecov.io](https://codecov.io/gh/jeyroik/toncenter-php-sdk/coverage.svg?branch=master)
<a href="https://github.com/phpstan/phpstan"><img src="https://img.shields.io/badge/PHPStan-enabled-brightgreen.svg?style=flat" alt="PHPStan Enabled"></a> 
<a href="https://codeclimate.com/github/jeyroik/toncenter-php-sdk/maintainability"><img src="https://api.codeclimate.com/v1/badges/ec3578c5a44df50d3317/maintainability" /></a>
[![Latest Stable Version](https://poser.pugx.org/jeyroik/toncenter-php-sdk/v)](//packagist.org/packages/jeyroik/toncenter-php-sdk)
[![Total Downloads](https://poser.pugx.org/jeyroik/toncenter-php-sdk/downloads)](//packagist.org/packages/jeyroik/toncenter-php-sdk)
[![Dependents](https://poser.pugx.org/jeyroik/toncenter-php-sdk/dependents)](//packagist.org/packages/jeyroik/toncenter-php-sdk)


# usage

## Working with address

```php
$address = new Address([Address::FIELD__HASH => 'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0Yr']);
$address->loadInformation();

echo $address->getBalance(); // 15684203405
echo $address->getBalanceAsToncoins(); // 15,684203405

echo $address->getLastTransation()->getHash();
```

## Working with transactions

```php
$repo = new TransactionRepository();
$transaction = $repo->one(
    'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr', // by which address need to search transactions
    [
        ITransaction::FIELD__IN_MESSAGE => [
            ITransactionInMessage::FIELD__SOURCE => ['=', 'EQCtiv7PrMJImWiF2L5oJCgPnzp-VML2CAt5cbn1VsKAxLiE'],
            ITransactionInMessage::FIELD__VALUE => ['>', '9600000000'], //9.6 toncoins
            ITransactionInMessage::FIELD__MESSAGE_DATA => [
                ITransactionMessageData::FIELD__TEXT => ['like', 'ZWZ']
            ]
        ],
        ITransaction::FIELD__FEE => ['in', [1192940]]
    ]
);

echo $transaction->getId()->getHash() . PHP_EOL;

$transactions = $repo->all(
    'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr',
    [
        ITransaction::FIELD__IN_MESSAGE => [
            ITransactionInMessage::FIELD__SOURCE => ['=', 'EQCtiv7PrMJImWiF2L5oJCgPnzp-VML2CAt5cbn1VsKAxLiE'],
        ]
    ]
);

foreach($transactions as $transaction) {
    echo $transaction->getId()->getHash() . PHP_EOL;
}
```

### Enabled conditions

- `=` equal
- `!=` not equal
- `>` greater
- `>=` greater or equal
- `<` lower
- `<=` lower or equal
- `in` equal to one among a given list
- `nin` not equal to none of all given list
- `like` contains
- `nlike` not contains