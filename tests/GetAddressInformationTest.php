<?php

use PHPUnit\Framework\TestCase;
use tonc\components\addresses\Address;

class GetAddressInformationTest extends TestCase
{
    public function testGetInformation()
    {
        sleep(2);// toncenter rps limit 1
        $address = new Address([Address::FIELD__HASH => 'EQA6VbfxOrYGXvQw-VEpqeFKD1YDtX7JkQmENXOTV93Am0yr']);
        $address->loadInformation();

        $this->assertEquals('raw.fullAccountState', $address->getType(), print_r($address, true));
    }
}
