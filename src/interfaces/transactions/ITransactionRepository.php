<?php
namespace tonc\interfaces\transactions;

interface ITransactionRepository
{
    /**
     * @param string $addressHash
     * @param array $query
     * 
     * @return ITransaction
     */
    public function one(string $addressHash, array $query): ?ITransaction;

    /**
     * @param string $addressHash
     * @param array $query
     * 
     * @return ITransaction[]
     */
    public function all(string $addressHash, array $query): array;
}
