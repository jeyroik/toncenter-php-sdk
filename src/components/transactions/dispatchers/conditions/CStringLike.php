<?php
namespace tonc\components\transactions\dispatchers\conditions;

use tonc\interfaces\transactions\dispatchers\conditions\ICondition;

class CStringLike implements ICondition
{
    /**
     * @param string $source
     * @param string|array $target
     */
    public function __invoke($source, $target): bool
    {
        if (is_array($target)) {
            foreach ($target as $item) {
                if (!str_contains($source, $target)) {
                    return false;
                }
            }
            return true;
        }

        return str_contains($source, $target);
    }
}
