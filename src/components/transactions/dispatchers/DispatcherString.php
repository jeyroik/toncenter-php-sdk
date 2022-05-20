<?php
namespace tonc\components\transactions\dispatchers;

use tonc\interfaces\transactions\dispatchers\IDispatcher;
use tonc\components\THasDispatchers;

class DispatcherString implements IDispatcher
{
    use THasDispatchers;

    /**
     * @param string $source
     * @param string $condition
     * @param string|array $target
     */
    public function __invoke($source, string $condition, $target): bool
    {
        $available = [
            '=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringEqual',
            '!=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringNotEqual',
            '>' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringGreater',
            '>=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringGreaterOrEqual',
            '<' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringLower',
            '<=' => 'tonc\\components\\transactions\\dispatchers\\conditions\\CStringLowerOrEqual',
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
