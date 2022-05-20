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

    public function getAttribute(string $name, $default = null): mixed
    {
        return $this->attributes[$name] ?? $default;
    }
}
