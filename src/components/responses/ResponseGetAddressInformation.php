<?php
namespace tonc\components\responses;

use tonc\components\THasAttributes;
use tonc\interfaces\responses\IResponseGetAddressInformation;
use tonc\components\addresses\Address;

class ResponseGetAddressInformation extends Response implements IResponseGetAddressInformation
{
    use THasAttributes;

    public function __toAddress(): IAddress
    {
        $result = $this->getResult();

        return new Address($result);
    }
}
