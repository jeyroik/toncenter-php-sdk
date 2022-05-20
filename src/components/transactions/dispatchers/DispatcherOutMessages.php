<?php
namespace tonc\components\transactions\dispatchers;

use tonc\components\THasDispatchers;
use tonc\interfaces\transactions\ITransactionOutMessage;

/**
 * Return true if at least one "out message" is applicable.
 */
class DispatcherOutMessages
{
    use THasDispatchers;

    /**
     * @param object $source
     * @param string $condition
     * @param array $target [field1 => condition1, ...]
     */
    public function __invoke($source, string $condition, $target): bool
    {
        $dispatchers = $this->getDispatchersList();

        foreach($target as $field => $targetValue) {
            $key = array_key_first($targetValue);
            if (is_numeric($key)) {
                list($condition, $targetValue) = $targetValue;
            } else {
                $condition = '';
            }
            
            $applicable = false;
            foreach($source as $message) {
                if (isset($dispatchers[$field])
                    && $this->buildDispatcher($dispatchers[$field])($message[$field], $condition, $targetValue)) {
                    $applicable = true;
                } else {
                    $applicable = false;
                    break;
                }
            }

            if ($applicable) {
                return true;
            }
        }

        return false;
    }

    protected function getDispatchersList(): array
    {
        return [
            ITransactionOutMessage::FIELD__TYPE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionOutMessage::FIELD__SOURCE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionOutMessage::FIELD__DESTINATION => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionOutMessage::FIELD__FORWARD_FEE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionOutMessage::FIELD__IHR_FEE => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionOutMessage::FIELD__CREATED_LT => 'tonc\\components\\transactions\\dispatchers\\DispatcherNumber',
            ITransactionOutMessage::FIELD__BODY_HASH => 'tonc\\components\\transactions\\dispatchers\\DispatcherString',
            ITransactionOutMessage::FIELD__MESSAGE_DATA => 'tonc\\components\\transactions\\dispatchers\\DispatcherMessageData',
            ITransactionOutMessage::FIELD__MESSAGE => 'tonc\\components\\transactions\\dispatchers\\DispatcherString'
        ];
    }
}
