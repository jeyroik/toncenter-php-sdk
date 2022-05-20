<?php
namespace tonc\components;

trait THasDispatchers
{
    protected function buildDispatcher(string $class)
    {
        return new $class();
    }
}
