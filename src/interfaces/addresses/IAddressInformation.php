<?php
namespace tonc\interfaces\addresses;

use tonc\interfaces\transactions\ILastTransaction;
use tonc\interfaces\blocks\IBlock;
use tonc\interfaces\ICanBeAsArray;
use tonc\interfaces\IHaveAttributes;

interface IAddressInformation extends \ArrayAccess, \Iterator, IHaveAttributes
{
    public const FIELD__BALANCE = 'balance';
    public const FIELD__LAST_TRANSACTION = 'last_transaction_id';
    public const FIELD__BLOCK = 'block_id';
    public const FIELD__STATE = 'state';
    public const FIELD__CODE = 'code';
    public const FIELD__TYPE = '@type';
    public const FIELD__DATA = 'data';
    public const FIELD__FROZEN_HASH = 'frozen_hash';
    public const FIELD__SYNC_UTIME = 'sync_utime';
    public const FIELD__EXTRA = '@extra';

    public const STATE__ACTIVE = 'active';

    public const BALANCE__RATE = 1000000000;

    public function getBalance(): int;
    public function getBalanceAsToncoins(): float;

    public function getLastTransaction(): ILastTransaction;

    public function getBlock(): IBlock;

    public function getState(): string;

    public function isActive(): bool;

    public function getCode(): string;
    public function getType(): string;
    public function getData(): string;
    public function getFrozenHash(): string;
    public function getSyncUTime(): int;
    public function getExtra(): string;
}
