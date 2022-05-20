<?php
namespace tonc\components\transaction;

use tonc\components\THasAttributes;
use tonc\components\THasType;
use tonc\interfaces\transactions\ITransactionMessageData;

class TransactionMessageData implements ITransactionMessageData
{
    use THasAttributes;
    use THasType;

    public function getText(): string
    {
        return $this->getAttribute(static::FIELD__TEXT, '');
    }

    public function getInitState(): string
    {
        return $this->getAttribute(static::FIELD__INIT_STATE, '');
    }
}
