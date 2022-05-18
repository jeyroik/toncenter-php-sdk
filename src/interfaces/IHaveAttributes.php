<?php
namespace tonc\interfaces;

interface IHaveAttributes extends ICanBeAsArray
{
    public function __construct(array $attributes);
}
