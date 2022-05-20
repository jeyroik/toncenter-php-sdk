<?php
namespace tonc\components;

use tonc\interfaces\IHaveType;

/**
 * Implements IHaveType interface
 * 
 * @property array $attributes
 * 
 * @require tonc\interfaces\IHaveAttributes
 */
trait THasType
{
    public function getType(): string
    {
        return $this->getAttribute(IHaveType::FIELD__TYPE, '');
    }
}
