<?php
namespace tonc\components\transactions\dispatchers;

use tonc\interfaces\transactions\ITransactionMessageData;

class DispatcherMessageData extends DispatcherObject
{
    protected function getDispatchersList(): array
    {
        return [
            ITransactionMessageData::FIELD__TYPE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionMessageData::FIELD__TEXT => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionMessageData::FIELD__INIT_STATE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString'
        ];
    }
}
