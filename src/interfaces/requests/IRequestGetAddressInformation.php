<?php
namespace tonc\interfaces\requests;

use tonc\interfaces\responses\IResponseGetAddressInformation;

interface IRequestGetAddressInformation
{
    public const PARAMETER__ADDRESS = 'address';
    public const FIELD__ADDRESS = 'address';
    public const PATH = 'getAddressInformation';

    public function run(): IResponseGetAddressInformation;
}
