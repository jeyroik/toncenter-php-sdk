<?php
namespace tonc\components\transactions;

use tonc\interfaces\transactions\ILastTransaction;
use tonc\components\THasAttributes;

class LastTransaction implements ILastTransaction
{
    use THasAttributes;

    public function __toString()
    {
        return $this->getHash();
    }

    public function getHash(): string
    {
        return $this->attributes[static::FIELD__HASH] ?? '';
    }

    public function getLt(): string
    {
        return $this->attributes[static::FIELD__LT] ?? '';
    }

    public function getType(): string
    {
        return $this->attributes[static::FIELD__TYPE] ?? 0;
    }
}
