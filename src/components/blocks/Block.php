<?php
namespace tonc\components\blocks;

use tonc\interfaces\blocks\IBlock;
use tonc\components\THasAttributes;

class Block implements IBlock
{
    use THasAttributes;

    public function getType(): string
    {
        return $this->attributes[static::FIELD__TYPE] ?? '';
    }

    public function getWorkchain(): int
    {
        return $this->attributes[static::FIELD__WORKCHAIN] ?? 0;
    }

    public function getShard(): string
    {
        return $this->attributes[static::FIELD__SHARD] ?? '';
    }

    public function getSegNo(): int
    {
        return $this->attributes[static::FIELD__SEQ_NO] ?? 0;
    }

    public function getRootHash(): string
    {
        return $this->attributes[static::FIELD__ROOT_HASH] ?? '';
    }

    public function getFileHash(): string
    {
        return $this->attributes[static::FIELD__FILE_HASH] ?? '';
    }
}
