<?php
namespace tonc\interfaces\responses;

use tonc\interfaces\IHaveAttributes;

interface IResponse extends \ArrayAccess, \Iterator, IHaveAttributes
{
    public const FIELD__BODY = 'body';
    public const FIELD__STATUS = 'status';

    public function isSuccess(): bool;
    public function getResult(): array;
}
