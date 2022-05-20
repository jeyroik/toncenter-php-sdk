<?php
namespace tonc\interfaces\transactions;

use tonc\interfaces\IHaveAttributes;
use tonc\interfaces\IHaveType;

interface ITransactionId extends IHaveAttributes, IHaveType
{
    public const FIELD__LT = 'lt';
    public const FIELD__HASH = 'hash';

    public function getLt(): int;
    public function getHash(): string;
}
