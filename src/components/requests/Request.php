<?php
namespace tonc\components\request;

use \GuzzleHttp\Client;
use \GuzzleHttp\ClientInterface;
use tonc\interfaces\responses\IResponse;
use tonc\components\responses\Response;

/**
 * Usage:
 * 
 * $request = new Request([
 *  Request::FIELD__METHOD => Request::METHOD__GET,
 *  Request::FIELD__ENDPOINT => 'operationName', //for example getAddressInformation
 *  Request::FIELD__PARAMETERS => [
 *    'param1' => 'value1'
 *  ]
 * ]);
 * 
 * $response = $request->run();
 * 
 * print_r($response->__toArray(), true);
 */
class Request implements IRequest
{
    use THasAttributes;

    public function run(): IResponse
    {
        return $this->getMethod() == static::METHOD__GET ? $this->runGet() : $this->runPost();
    }

    public function getMethod(): string
    {
        return $this->attributes[static::FIELD__METHOD] ?? static::METHOD__DEFAULT;
    }

    public function getEndpoint(): string
    {
        $path = $this->attributes[static::FIELD__ENDPOINT] ?? '';

        return static::BASE__URL . $this->getVersionPrefix() . $path;
    }

    public function getParameters(): array
    {
        return $this->attributes[static::FIELD__PARAMETERS] ?? [];
    }

    protected function runGet(): IResponse
    {
        $client = $this->getHttpClient();
        $response = $client->request(
            $this->getMethod(), 
            $this->getEndpoint() . '?' . http_build_query($this->getParameters())
        );

        return new Response([
            Response::FIELD__BODY => $response->getBody(),
            Response::FIELD__STATUS => $response->getStatusCode()
        ]);
    }

    protected function runPost(): IResponse
    {
        $client = $this->getHttpClient();
        $client->request(
            $this->getMethod(), 
            $this->getEndpoint(), [
            'form_params' => $this->getParameters()
        ]);

        return new Response([
            Response::FIELD__BODY => $response->getBody(),
            Response::FIELD__STATUS => $response->getStatusCode()
        ]);
    }

    protected function getVersionPrefix(): string
    {
        $prefixes = [
            1 => '/api/v1/',
            2 => '/api/v2/'
        ];

        return $prefixes[$this->getVersion()] ?? $prefixes[static::VERSION__DEFAULT];
    }

    protected function getHttpClient(): ClientInterface
    {
        return new Client();
    }
}
