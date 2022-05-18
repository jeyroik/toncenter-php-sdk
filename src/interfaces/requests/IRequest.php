<?php
namespace tonc\interfaces\requests;

use tonc\interfaces\responses\IResponse;

interface IRequest
{
    public const FIELD__METHOD = 'method';
    public const METHOD__GET = 'GET';
    public const METHOD__POST = 'POST';
    public const METHOD__DEFAULT = self::METHOD__GET;

    public const FIELD__ENDPOINT = 'endpoint';
    public const FIELD__VERSION = 'version';
    public const VERSION__2 = 2;
    public const VERSION__DEFAULT = self::VERSION__2;

    public const FIELD__PARAMETERS = 'parameters';
    
    public const BASE__URL = 'https://toncenter.com';

    public function run(): IResponse;

    public function getMethod(): string;
    public function getEndpoint(): string;
    public function getParameters(): array;
    public function getVersion(): int;
}
