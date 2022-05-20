<?php
namespace tonc\components\responses;

use tonc\components\THasAttributes;
use tonc\interfaces\responses\IResponseGetTransactions;
use tonc\components\transactions\Transaction;
use tonc\interfaces\transactions\ITransaction;

class ResponseGetTransactions extends Response implements IResponseGetTransactions
{
    use THasAttributes;

    public function getTransactions()
    {
        $result = $this->getResult();

        foreach ($result as $transactionRaw) {
            yield new Transaction($transactionRaw);
        }
    }

    public function last(): ITransaction
    {
        $transactions = $this->getResult();
        return new Transaction(array_pop($transactions));
    }

    public function first(): ITransaction
    {
        $transactions = $this->getResult();
        return new Transaction(array_shift($transactions));
    }
}
