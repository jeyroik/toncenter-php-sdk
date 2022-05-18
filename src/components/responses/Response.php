<?php
namespace tonc\components\responses;

use tonc\interfaces\responses\IResponse;
use tonc\components\THasAttributes;

class Response implements IResponse
{
    use THasAttributes;

    public function isSuccess(): bool
    {
        $body = $this->getBodyAsArray();

        return (bool) $body[static::FIELD__OK];
    }

    public function getResult(): array
    {
        $body = $this->getBodyAsArray();

        return $body[static::FIELD__RESULT] ?? [];
    }

    protected function getBody(): string
    {
        return $this->attributes[static::FIELD__BODY] ?? '';
    }

    protected function getBodyAsArray(): array
    {
        if (!isset($this->attributes[static::FIELD__BODY_AS_ARRAY])) {
            $this->attributes[static::FIELD__BODY_AS_ARRAY] = json_decode($this->getBody(), true);
        }

        return $this->attributes[static::FIELD__BODY_AS_ARRAY];
    }
}
