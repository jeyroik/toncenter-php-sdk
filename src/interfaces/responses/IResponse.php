<?php
namespace tonc\interfaces\responses;

use tonc\interfaces\IHaveAttributes;

interface IResponse extends \ArrayAccess, \Iterator, IHaveAttributes
{
    public const FIELD__BODY = 'body';
    public const FIELD__BODY_AS_ARRAY = 'body_array';
    public const FIELD__STATUS = 'status';

    public const FIELD__OK = 'ok';
    public const FIELD__RESULT = 'result';

    public function isSuccess(): bool;
    public function getResult(): array;
}
