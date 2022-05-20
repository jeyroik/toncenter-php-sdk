<?php
namespace tonc\components\addresses;

use tonc\interfaces\addresses\IAddress;
use tonc\interfaces\transactions\ILastTransaction;
use tonc\components\transactions\LastTransaction;
use tonc\interfaces\blocks\IBlock;
use tonc\components\blocks\Block;
use tonc\components\THasAttributes;
use tonc\components\requests\RequestGetAddressInformation;

/**
 * Usage:
 * $address = new Address([Address::FIELD__HASH => '<hash>']);
 * $address->loadInformation();
 * 
 * echo $address->getBalanceAsToncoins();
 */
class Address extends AddressInformation implements IAddress
{
    public function getHash(): string
    {
        return $this->attributes[static::FIELD__HASH] ?? '';
    }

    public function loadInformation(): void
    {
        $request = new RequestGetAddressInformation([
            RequestGetAddressInformation::FIELD__ADDRESS => $this->getHash()
        ]);

        $response = $request->run();

        if ($response->isSuccess()) {
            $hash = $this->getHash();
            $this->attributes = $response->__toAddressInformation()->__toArray();
            $this->attributes[static::FIELD__HASH] = $hash;
        }
    }
}
