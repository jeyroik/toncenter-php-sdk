<?php
namespace tonc\components\transactions\dispatchers;

use tonc\interfaces\transactions\ITransactionId;

class DispatcherTransactionId extends DispatcherObject
{
    protected function getDispatchersList(): array
    {
        return [
            ITransactionId::FIELD__TYPE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionId::FIELD__LT => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionId::FIELD__HASH => 'tonc\\components\\transactions\\dispatchers\\DispatcherString'
        ];
    }
}
