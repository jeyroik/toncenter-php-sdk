<?php
namespace tonc\interfaces\transactions;

use tonc\interfaces\IHaveAttributes;
use tonc\interfaces\IHaveType;

interface ITransactionInMessage extends IHaveAttributes, IHaveType
{
    public const FIELD__SOURCE = 'source';
    public const FIELD__DESTINATION = 'destination';
    public const FIELD__VALUE = 'value';
    public const FIELD__FORWARD_FEE = 'fwd_fee';
    public const FIELD__IHR_FEE = 'ihr_fee';
    public const FIELD__CREATED_LT = 'created_lt';
    public const FIELD__BODY_HASH = 'body_hash';
    public const FIELD__MESSAGE_DATA = 'msg_data';
    public const FIELD__MESSAGE = 'message';

    public function getSource(): string;
    public function getDestination(): string;
    public function getValue(): int;
    public function getForwardFee(): int;
    public function getIHRFee(): int;
    public function getCreatedLT(): int;
    public function getBodyHash(): string;
    public function getMessageData(): ITransactionMessageData;
    public function getMessage(): string;
}
