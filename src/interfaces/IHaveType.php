<?php
namespace tonc\interfaces;

interface IHaveType
{
    public const FIELD__TYPE = '@type';

    public function getType(): string;
}
