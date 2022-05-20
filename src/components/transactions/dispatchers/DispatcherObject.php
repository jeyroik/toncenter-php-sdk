<?php
namespace tonc\components\transactions\dispatchers;

use tonc\interfaces\transactions\dispatchers\IDispatcher;
use tonc\components\THasDispatchers;

abstract class DispatcherObject implements IDispatcher
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
            if (!isset($dispatchers[$field])
                || !$this->buildDispatcher($dispatchers[$field])($source[$field], $condition, $targetValue)) {
                return false;
            }
        }

        return true;
    }

    abstract protected function getDispatchersList(): array;
}
