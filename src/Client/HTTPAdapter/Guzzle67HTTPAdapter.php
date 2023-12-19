<?php

namespace YouCan\Shop\Sdk\Client\HTTPAdapter;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use YouCan\Shop\Sdk\Client\Response;
use YouCan\Shop\Sdk\Endpoints\Exceptions\InvalidResponseException;

class Guzzle67HTTPAdapter extends HTTPAdapter
{
    private GuzzleClient $httpClient;

    public function __construct(array $clientConfig = [])
    {
        parent::__construct();

        $this->httpClient = new GuzzleClient(
            array_merge($clientConfig, [
                'base_uri'                  => $this->getBaseUrl(),
                RequestOptions::HTTP_ERRORS => false,
                RequestOptions::HEADERS     => [
                    'Content-Type' => 'application/json',
                    'Accept'       => 'application/json',
                ],
            ])
        );
    }

    public function request(string $method, string $endpoint, array $params = [], array $headers = []): Response
    {
        $this->addTokenToHeader($headers);

        $response = $this->httpClient->request($method, $endpoint, [
            RequestOptions::FORM_PARAMS => $params,
            RequestOptions::QUERY       => $params,
            RequestOptions::HEADERS     => $headers,
        ]);

        $this->assertSuccessResponsePayload($response);

        $responseBody = json_decode((string)$response->getBody(), true);

        return new Response($response->getStatusCode(), is_array($responseBody) ? $responseBody : []);
    }

    private function assertSuccessResponsePayload(ResponseInterface $response): void
    {
        $responseBody = json_decode((string)$response->getBody(), true);

        $successResponseWithWrongBody = $response->getStatusCode() === 200 && !is_array($responseBody);
        if ($successResponseWithWrongBody) {
            throw new InvalidResponseException(
                'Invalid response',
                (string)$response->getBody(),
                $response->getStatusCode()
            );
        }
    }
}
