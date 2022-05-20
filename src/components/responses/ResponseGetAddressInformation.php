<?php
namespace tonc\components\responses;

use tonc\components\THasAttributes;
use tonc\interfaces\responses\IResponseGetAddressInformation;
use tonc\components\addresses\AddressInformation;
use tonc\interfaces\addresses\IAddressInformation;

class ResponseGetAddressInformation extends Response implements IResponseGetAddressInformation
{
    use THasAttributes;

    public function __toAddressInformation(): IAddressInformation
    {
        $result = $this->getResult();

        return new AddressInformation($result);
    }
}
