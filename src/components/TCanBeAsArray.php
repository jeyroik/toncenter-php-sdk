<?php
namespace tonc\components;

/**
 * Implements ICanBeAsArray interface
 */
trait TCanBeAsArray
{
    protected array $attributes = [];

    public function __toArray(): array
    {
        return $this->attributes ?? [];
    }
}
