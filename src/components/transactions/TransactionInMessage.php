<?php
namespace tonc\components\transactions;

use tonc\components\THasAttributes;
use tonc\components\THasType;
use tonc\components\transactions\TransactionMessageData;
use tonc\interfaces\transactions\ITransactionMessageData;
use tonc\interfaces\transactions\ITransactionInMessage;

class TransactionInMessage implements ITransactionInMessage
{
    use THasAttributes;
    use THasType;

    public function getSource(): string
    {
        return $this->getAttribute(static::FIELD__SOURCE, '');
    }

    public function getDestination(): string
    {
        return $this->getAttribute(static::FIELD__DESTINATION, '');
    }

    public function getValue(): int
    {
        return $this->getAttribute(static::FIELD__VALUE, 0);
    }

    public function getForwardFee(): int
    {
        return $this->getAttribute(static::FIELD__FORWARD_FEE, 0);
    }

    public function getIHRFee(): int
    {
        return $this->getAttribute(static::FIELD__IHR_FEE, 0);
    }

    public function getCreatedLT(): int
    {
        return $this->getAttribute(static::FIELD__CREATED_LT, 0);
    }

    public function getBodyHash(): string
    {
        return $this->getAttribute(static::FIELD__BODY_HASH, '');
    }

    public function getMessageData(): ITransactionMessageData
    {
        $data = $this->getAttribute(static::FIELD__MESSAGE_DATA, []);

        return new TransactionMessageData($data);
    }

    public function getMessage(): string
    {
        return $this->getAttribute(static::FIELD__MESSAGE, '');
    }
}
