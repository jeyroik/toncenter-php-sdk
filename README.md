# toncenter-php-sdk
PHP SDK for toncenter

# usage

```php
$address = new Address([Address::FIELD__HASH => 'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0Yr']);
$address->loadInformation();

echo $address->getBalance(); // 15684203405
echo $address->getBalanceAsToncoins(); // 15,684203405

echo $address->getLastTransation()->getHash();
```