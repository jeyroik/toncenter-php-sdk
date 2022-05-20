<?php
namespace tonc\components\transactions\dispatchers;

use tonc\interfaces\transactions\ITransactionInMessage;

class DispatcherInMessage extends DispatcherObject
{
    protected function getDispatchersList(): array
    {
        return [
            ITransactionInMessage::FIELD__TYPE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionInMessage::FIELD__SOURCE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionInMessage::FIELD__DESTINATION => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionInMessage::FIELD__VALUE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionInMessage::FIELD__FORWARD_FEE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionInMessage::FIELD__IHR_FEE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionInMessage::FIELD__CREATED_LT => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionInMessage::FIELD__BODY_HASH => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionInMessage::FIELD__MESSAGE_DATA => 'tonc\\components\\transactions\\dispatchers\\DispatcherMessageData',
            ITransactionInMessage::FIELD__MESSAGE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString'
        ];
    }
}
