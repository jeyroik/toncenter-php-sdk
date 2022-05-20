<?php
namespace tonc\components\transactions;

use tonc\components\THasAttributes;
use tonc\components\THasType;
use tonc\interfaces\transactions\ITransactionMessageData;

class TransactionMessageData implements ITransactionMessageData
{
    use THasAttributes;
    use THasType;

    public function __call($method, $args)
    {
        if(str_contains($method, 'get')) {
            $field = strtolower(substr($method, 3));
            return $this->getAttribute($field, '');
        }

        return '';
    }

    public function getText(): string
    {
        return $this->getAttribute(static::FIELD__TEXT, '');
    }

    public function getInitState(): string
    {
        return $this->getAttribute(static::FIELD__INIT_STATE, '');
    }
}
