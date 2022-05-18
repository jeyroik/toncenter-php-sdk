<?php
namespace tonc\interfaces\transactions;

use tonc\interafces\IHaveAttributes;

interface ILastTransaction extends IHaveAttributes
{
    public const FIELD__HASH = 'hash';
    public const FIELD__LT = 'lt';
    public const FIELD__TYPE = 'type';

    public const TYPE__INTERNAL = 'internal.transactionId';

    public function getHash(): string;
    public function getLt(): string;
    public function getType(): string;
}
