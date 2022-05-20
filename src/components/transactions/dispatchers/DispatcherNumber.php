<?php
namespace tonc\components\transactions\dispatchers;

use tonc\interfaces\transactions\dispatchers\IDispatcher;
use tonc\components\THasDispatchers;

class DispatcherNumber implements IDispatcher
{
    use THasDispatchers;

    /**
     * @param numeric $source
     * @param string $condition
     * @param numeric|array $target
     */
    public function __invoke($source, string $condition, $target): bool
    {
        $available = [
            '=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringEqual',
            '!=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringNotEqual',
            '>' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CNumberGreater',
            '>=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CNumberGreaterOrEqual',
            '<' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CNumberLower',
            '<=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CNumberLowerOrEqual',
            'in' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CIn',
            'nin' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CNotIn',
            'like' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringLike',
            'nlike' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringNotLike',
        ];

        return isset($available[$condition]) 
            ? $this->buildDispatcher($available[$condition])($source, $target)
            : false;
    }
}
