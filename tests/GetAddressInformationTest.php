<?php

use PHPUnit\Framework\TestCase;

class GetAddressInformationTest extends TestCase
{
    public function testGetInformation()
    {
        $address = new Address([Address::FIELD__HASH => '']);
        $address->loadInformation();

        $this->assertEquals('raw.fullAccountState', $address->getType());
    }
}
