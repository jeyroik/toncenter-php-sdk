<?php
namespace tonc\components\transactions;

use tonc\components\THasAttributes;
use tonc\components\THasType;
use tonc\interfaces\transactions\ITransactionId;

class TransactionId implements ITransactionId
{
    use THasAttributes;
    use THasType;

    public function getLt(): int
    {
        return $this->getAttribute(static::FIELD__LT, 0);
    }

    public function getHash(): string
    {
        return $this->getAttribute(static::FIELD__HASH, '');
    }
}
