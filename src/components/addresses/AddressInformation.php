<?php
namespace tonc\components\addresses;

use tonc\interfaces\addresses\IAddressInformation;
use tonc\interfaces\transactions\ILastTransaction;
use tonc\components\transactions\LastTransaction;
use tonc\interfaces\blocks\IBlock;
use tonc\components\blocks\Block;
use tonc\components\THasAttributes;

class AddressInformation implements IAddressInformation
{
    use THasAttributes;

    public function getBalance(): int
    {
        return $this->attributes[static::FIELD__BALANCE] ?? 0;
    }
    
    public function getBalanceAsToncoins(): float
    {
        $balance = $this->getBalance();

        return $balance / static::BALANCE__RATE;
    }

    public function getLastTransaction(): ILastTransaction
    {
        $rawData = $this->attributes[static::FIELD__LAST_TRANSACTION] ?? [];

        return new LastTransaction($rawData);
    }

    public function getBlock(): IBlock
    {
        $rawData = $this->attributes[static::FIELD__BLOCK] ?? [];

        return new Block($rawData);
    }

    public function getState(): string
    {
        return $this->attributes[static::FIELD__STATE] ?? '';
    }

    public function isActive(): bool
    {
        return $this->getState() == static::STATE__ACTIVE;
    }

    public function getCode(): string
    {
        return $this->attributes[static::FIELD__CODE] ?? '';
    }

    public function getType(): string
    {
        return $this->attributes[static::FIELD__TYPE] ?? '';
    }

    public function getData(): string
    {
        return $this->attributes[static::FIELD__DATA] ?? '';
    }

    public function getFrozenHash(): string
    {
        return $this->attributes[static::FIELD__FROZNE_HASH] ?? '';
    }

    public function getSyncUTime(): int
    {
        return $this->attributes[static::FIELD__SYNC_UTIME] ?? 0;
    }
    
    public function getExtra(): string
    {
        return $this->attributes[static::FIELD__EXTRA] ?? '';
    }
}
