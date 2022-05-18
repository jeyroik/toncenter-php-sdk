<?php
namespace tonc\interfaces\addresses\address;

interface IAddress extends IAddressInformation
{
    public const FIELD__HASH = 'hash';

    public function getHash(): string;
    public function loadInformation(): void;
}
