<?php
namespace tonc\interfaces\transactions;

use tonc\interfaces\IHaveAttributes;
use tonc\interfaces\IHaveType;

/**
 * Actually, properties of a message data is not defined, so
 * todo: need to allow get any property from a message data.
 */
interface ITransactionMessageData extends IHaveAttributes, IhaveType
{
    public const FIELD__TEXT = 'text';
    public const FIELD__INIT_STATE = 'init_state';

    public function getText(): string;
    public function getInitState(): string;
}
