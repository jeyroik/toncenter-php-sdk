<?php
namespace tonc\components\transactions\dispatchers\conditions;

use tonc\interfaces\transactions\dispatchers\conditions\ICondition;

class CNotIn implements ICondition
{
    /**
     * @param string $source
     * @param string|array $target
     */
    public function __invoke($source, $target): bool
    {
        return !in_array($source, $target);
    }
}
