<?php
namespace tonc\interfaces\responses;

use tonc\interafces\IHaveAttributes;

interface IResponse extends \ArrayAccess, \Iterator, IHaveAttributes
{
    public function isSuccess(): bool;
    public function getResult(): array;
}
