<?php
namespace tonc\interfaces\transactions\dispatchers;

interface IDispatcher
{
    public function __invoke($source, string $condition, $target): bool;
}
