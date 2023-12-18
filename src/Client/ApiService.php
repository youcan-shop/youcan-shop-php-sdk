<?php

namespace YouCan\Shop\Sdk\Client;

use YouCan\Shop\Sdk\Client\HTTPAdapter\HTTPAdapter;
use YouCan\Shop\Sdk\Client\HTTPAdapter\HTTPAdapterPicker;
use YouCan\Shop\Sdk\Endpoints\Exceptions\InvalidResponseException;
use YouCan\Shop\Sdk\Endpoints\Exceptions\NotFoundException;
use YouCan\Shop\Sdk\Models\AccessToken;

final class ApiService implements ApiServiceInterface
{
    public bool $isSandboxMode = false;

    private HTTPAdapter $httpAdapter;

    public function __construct(HTTPAdapterPicker $adapterPicker)
    {
        $this->httpAdapter = $adapterPicker->pickAdapter($this->isSandboxMode);
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return Response
     * @throws InvalidResponseException
     */
    public function post(string $endpoint, array $params = []): Response
    {
        return $this->request($endpoint, 'POST', $params);
    }

    public function request(string $endpoint, string $method, array $params = []): Response
    {
        $response = $this->getHttpAdapter()->request($method, $endpoint,$params);

        if ($response->getStatusCode() === 404) {
            NotFoundException::throw('resource not found');
        }
    }

    /**
     * @param string $endpoint
     * @param array $params
     * @return Response
     * @throws InvalidResponseException
     */
    public function get(string $endpoint, array $params = []): Response
    {
        return $this->request($endpoint, 'GET', $params);
    }

    private function getHttpAdapter(): HTTPAdapter
    {
        return $this->httpAdapter;
    }

    public function setToken(AccessToken $token): void
    {
        $this->httpAdapter->setToken($token);
    }
}
