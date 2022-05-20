<?php
namespace tonc\interfaces\responses;

use tonc\interfaces\transactions\ITransaction;

interface IResponseGetTransactions extends IResponse
{
    public function last(): ITransaction;
    public function first(): ITransaction;
}
