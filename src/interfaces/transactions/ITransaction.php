<?php
namespace tonc\interfaces\transactions;

use tonc\interfaces\IHaveAttributes;
use tonc\interfaces\IHaveType;

interface ITransaction extends IHaveAttributes, IHaveType, \ArrayAccess
{
    public const FIELD__UTIME = 'utime';
    public const FIELD__DATA = 'data';
    public const FIELD__ID = 'transaction_id';
    public const FIELD__FEE = 'fee';
    public const FIELD__STORAGE_FEE = 'storage_fee';
    public const FIELD__OTHER_FEE = 'other_fee';
    public const FIELD__IN_MESSAGE = 'in_msg';
    public const FIELD__OUT_MESSAGES = 'out_msgs';

    /**
     * Contains raw transaction data
     */
    public const FIELD__RAW = 'raw';

    public function getUtime(): int;
    public function getData(): string;
    public function getId(): ITransactionId;
    public function getFee(): int;
    public function getStorageFee(): int;
    public function getOtherFee(): int;
    public function getInMessage(): ITransactionInMessage;

    /**
     * @return ITransactionOutMessage[]
     */
    public function getOutMessages(): array;
}
