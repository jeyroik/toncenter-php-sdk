<?php
namespace tonc\interfaces\blocks;

use tonc\interfaces\IHaveAttributes;

interface IBlock extends IHaveAttributes
{
    public const FIELD__TYPE = 'type';
    public const FIELD__WORKCHAIN = 'workchain';
    public const FIELD__SHARD = 'shard';
    public const FIELD__SEQ_NO = 'seqno';
    public const FIELD__ROOT_HASH = 'root_hash';
    public const FIELD__FILE_HASH = 'file_hash';

    public const WORKCHAIN__MAIN = -1;

    public function getType(): string;
    public function getWorkchain(): int;
    public function getShard(): string;
    public function getSegNo(): int;
    public function getRootHash(): string;
    public function getFileHash(): string;
}
