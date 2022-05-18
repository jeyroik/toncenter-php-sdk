<?php
namespace tonc\components\requests;

use tonc\interfaces\requests\IRequestGetAddressInformation;

/**
 * Usage:
 * $request = new RequestGetAddressInformation([
 *  RequestGetAddressInformation::FIELD__ADDRESS => '<address>'
 * ]);
 * $response = $request->run();
 * 
 * $addressInformation = $response->__toAddressInformation();
 * echo $addressInformation->getBalance();
 */
class RequestGetAddressInformation implements IRequestGetAddressInformation
{
    public function run(): IResponseGetAddressInformation
    {
        $request = new Request([
            Request::FIELD__METHOD => Request::METHOD__GET,
            Request::FIELD__ENDPOINT => static::PATH,
            Request::FIELD__PARAMETERS => [
                static::PARAMETER__ADDRESS => $this->getAddressHash()
            ]
        ]);

        $response = $request->run();

        return new ResponseGetAddressInformation($response->__toArray());
    }

    protected function getAddressHash(): string
    {
        return $this->attributes[static::PARAMETER__ADDRESS] ?? '';
    }
}
