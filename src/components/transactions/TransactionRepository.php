<?php
namespace tonc\components\transactions;

use tonc\components\THasDispatchers;
use tonc\components\requests\RequestGetTransactions;
use tonc\interfaces\transactions\ITransactionRepository;
use tonc\interfaces\transactions\ITransaction;

/**
 * Usage:
 * 
 * $repo = new TransactionRepository();
 * 
 * $transaction = $repo->one('<address.hash>', [
 *  ITransaction::FIELD__IN_MESSAGE => [
 *      ITransactionInMessage::FIELD__SOURCE => ['=', '<addressFrom.hash>'],
 *      ITransactionInMessage::FIELD__VALUE => ['>', '15000000000']// 15 toncoins
 *  ],
 *  ITransaction::FIELD__FEE => ['<=', 100]
 * ]);
 * 
 * if ($transaction) {
 *  echo 'Found incoming payment for the sum greater than 1000000!';
 * }
 */
class TransactionRepository implements ITransactionRepository
{
    use THasDispatchers;

    /**
     * @param string $addressHash
     * @param array $query
     * 
     * @return ITransaction
     */
    public function one(string $addressHash, array $query): ?ITransaction
    {
        $request  = new RequestGetTransactions();
        $response = $request->forAddress($addressHash)->limit(100)->run();

        foreach ($response->getTransactions() as $transaction) {
            foreach($query as $field => $target) {
                $key = array_key_first($target);
                if (is_numeric($key)) {
                    list($condition, $value) = $target;
                } else {
                    $condition = '';
                    $value = $target;
                }

                if (!$this->is($transaction, $field, $condition, $value)) {
                    continue 2;
                }
            }
            return $transaction;
        }

        return null;
    }

    /**
     * @param string $addressHash
     * @param array $query
     * 
     * @return ITransaction[]
     */
    public function all(string $addressHash, array $query): array
    {
        $request  = new RequestGetTransactions();
        $response = $request->forAddress($addressHash)->limit(100)->run();
        $transactions = [];

        foreach ($response->getTransactions() as $transaction) {
            foreach($query as $field => $target) {
                $key = array_key_first($target);
                if (is_numeric($key)) {
                    list($condition, $value) = $target;
                } else {
                    $condition = '';
                    $value = $target;
                }
                if (!$this->is($transaction, $field, $condition, $value)) {
                    break;
                }
            }
            $transactions[] = $transaction;
        }

        return $transactions;
    }

    protected function is($transaction, $field, $condition, $target): bool
    {
        $fieldsDispatchers = [
            ITransaction::FIELD__TYPE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransaction::FIELD__UTIME => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransaction::FIELD__DATA => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransaction::FIELD__ID => 'tonc\\components\\transactions\\dispatchers\\DispatcherTransactionId',
            ITransaction::FIELD__FEE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransaction::FIELD__STORAGE_FEE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransaction::FIELD__OTHER_FEE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransaction::FIELD__IN_MESSAGE => 'tonc\\components\\transactions\\dispatchers\\DispatcherInMessage',
            ITransaction::FIELD__OUT_MESSAGES => 'tonc\\components\\transactions\\dispatchers\\DispatcherOutMessages'
        ];

        return isset($fieldsDispatchers[$field])
            ? $this->buildDispatcher($fieldsDispatchers[$field])($transaction[$field], $condition, $target)
            : false;
    }
}
