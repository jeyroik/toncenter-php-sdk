<?php
namespace tonc\interfaces\responses;

use tonc\interfaces\addresses\IAddressInformation;

interface IResponseGetAddressInformation extends IResponse
{
    public function __toAddressInformation(): IAddressInformation;
}
