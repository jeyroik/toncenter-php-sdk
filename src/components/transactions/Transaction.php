<?php
namespace tonc\components\transactions;

use tonc\interfaces\transactions\ITransaction;
use tonc\interfaces\transactions\ITransactionInMessage;
use tonc\interfaces\transactions\ITransactionId;
use tonc\components\transactions\TransactionInMessage;
use tonc\components\transactions\TransactionOutMessage;
use tonc\components\transactions\TransactionId;
use tonc\components\THasAttributes;
use tonc\components\THasType;

class Transaction implements ITransaction
{
    use THasAttributes;
    use THasType;
    
    public function getUtime(): int
    {
        return $this->getAttribute(static::FIELD__UTIME, 0);
    }

    public function getData(): string
    {
        return $this->getAttribute(static::FIELD__DATA, '');
    }

    public function getId(): ITransactionId
    {
        $id = $this->getAttribute(static::FIELD__ID, []);

        return new TransactionId($id);
    }

    public function getFee(): int
    {
        return $this->getAttribute(static::FIELD__FEE, 0);
    }

    public function getStorageFee(): int
    {
        return $this->getAttribute(static::FIELD__STORAGE_FEE, 0);
    }

    public function getOtherFee(): int
    {
        return $this->getAttribute(static::FIELD__OTHER_FEE, 0);
    }

    public function getInMessage(): ITransactionInMessage
    {
        $message = $this->getAttribute(static::FIELD__IN_MESSAGE, []);

        return new TransactionInMessage($message);
    }

    /**
     * @return ITransactionOutMessage[]
     */
    public function getOutMessages(): array
    {
        $messages = [];
        $data = $this->getAttribute(static::FIELD__OUT_MESSAGES, []);

        foreach($data as $item) {
            $messages[] = new TransactionOutMessage($item);
        }

        return $messages;
    }
}
