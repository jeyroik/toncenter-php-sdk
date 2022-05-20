<?php
namespace tonc\components\requests;

use tonc\interfaces\requests\IRequestGetTransactions;
use tonc\interfaces\responses\IResponseGetTransactions;
use tonc\components\responses\ResponseGetTransactions;
use tonc\components\requests\Request;

/**
 * Usage:
 * 
 * $request = new RequestGetTransactions();
 * $response = $request->forAddress('<hash>')
 *                         ->fromTransaction('<transaction.hash>')
 *                         ->to(<finish logical tme>)
 *                         ->withFullHistory()
 *                         ->limit(10)
 *                         ->run();
 * 
 * foreach($response->getTransactions() as $transaction) {
 *   echo $transaction->getValue();
 * }
 * 
 * echo $response->first()->getFee();
 */
class RequestGetTransactions implements IRequestGetTransactions
{
    public function run(): IResponseGetTransactions
    {
        $request = new Request([
            Request::FIELD__METHOD => Request::METHOD__GET,
            Request::FIELD__ENDPOINT => static::PATH,
            Request::FIELD__PARAMETERS => $this->attributes
        ]);

        $response = $request->run();

        return new ResponseGetTransactions($response->__toArray());
    }

    public function forAddress(string $addressHash): IRequestGetTransactions
    {
        $this->attributes[static::FIELD__ADDRESS] = $addressHash;

        return $this;
    }

    public function fromTransaction(string $transactionHash, int $lt = 0): IRequestGetTransactions
    {
        $this->attributes[static::FIELD__TRANSACTION] = $transactionHash;

        if ($lt > 0) {
            $this->attributes[static::FIELD__LT] = $lt;
        }

        return $this;
    }

    public function to(int $lt): IRequestGetTransactions
    {
        $this->attributes[static::FIELD__TO_LT] = $lt;

        return $this;
    }

    public function limit(int $limit): IRequestGetTransactions
    {
        $this->attributes[static::FIELD__LIMIT] = $limit;

        return $this;
    }

    public function withFullHistory(): IRequestGetTransactions
    {
        $this->attributes[static::FIELD__ARCHIVAL] = true;

        return $this;
    }

    public function withAnyAvailable(): IRequestGetTransactions
    {
        $this->attributes[static::FIELD__ARCHIVAL] = false;

        return $this;
    }
}
