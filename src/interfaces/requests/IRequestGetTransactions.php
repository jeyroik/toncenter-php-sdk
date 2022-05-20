<?php
namespace tonc\interfaces\requests;

use tonc\interfaces\responses\IResponseGetTransactions;

interface IRequestGetTransactions
{
    public const FIELD__ADDRESS = 'address';
    public const FIELD__LIMIT = 'limit';
    public const FIELD__LT = 'lt';
    public const FIELD__TO_LT = 'to_lt';
    public const FIELD__TRANSACTION = 'hash';
    public const FIELD__ARCHIVAL = 'archival';

    public const PATH = 'getTransactions';

    public function run(): IResponseGetTransactions;

    public function forAddress(string $addressHash): IRequestGetTransactions;
    public function fromTransaction(string $transactionHash, int $lt = 0): IRequestGetTransactions;
    public function to(int $lt): IRequestGetTransactions;
    public function limit(int $limit): IRequestGetTransactions;
    public function withFullHistory(): IRequestGetTransactions;
    public function withAnyAvailable(): IRequestGetTransactions;
}
