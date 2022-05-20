<?php
namespace tonc\components\transactions\dispatchers\conditions;

use tonc\interfaces\transactions\dispatchers\conditions\ICondition;

class CNumberLower implements ICondition
{
    /**
     * @param string $source
     * @param string|array $target
     */
    public function __invoke($source, $target): bool
    {
        if (is_array($target)) {
            foreach ($target as $item) {
                if ($source > $item) {
                    return false;
                }
            }
            return true;
        }

        return $source <= $target;
    }
}
