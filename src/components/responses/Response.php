<?php
namespace tonc\components\responses;

use tonc\interfaces\responses\IResponse;
use tonc\components\THasAttributes;

class Response implements IResponse
{
    use THasAttributes;

    public function isSuccess(): bool
    {
        return $this->attributes[static::FIELD__STATUS] == 200;
    }

    public function getResult(): array
    {
        $body = $this->attributes[static::FIELD__BODY] ?? [];

        return json_decode($body, true);
    }
}
