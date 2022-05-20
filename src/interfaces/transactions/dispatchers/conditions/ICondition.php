<?php
namespace tonc\interfaces\transactions\dispatchers\conditions;

interface ICondition
{
    public function __invoke($source, $target): bool;
}
