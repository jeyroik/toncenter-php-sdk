<?php
namespace tonc\interfaces;

interface ICanBeAsArray
{
    /**
     * @return array
     */
    public function __toArray(): array;
}
