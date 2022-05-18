<?php
namespace tonc\components;

/**
 * Implements IHaveAttributes interface
 */
trait THasAttributes
{
    use TCanBeAsArray;

    public function __construct(array $attributes)
    {
        $this->attributes = $attributes;
    }
}
