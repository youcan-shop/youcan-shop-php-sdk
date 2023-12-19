<?php

namespace YouCan\Shop\Sdk\Client;

use YouCan\Shop\Sdk\Client\HTTPAdapter\HTTPAdapter;
use YouCan\Shop\Sdk\Client\HTTPAdapter\HTTPAdapterPicker;
use YouCan\Shop\Sdk\Exceptions\UnauthorizedException;
use YouCan\Shop\Sdk\Endpoints\Exceptions\InvalidResponseException;
use YouCan\Shop\Sdk\Exceptions\NotFoundException;
use YouCan\Shop\Sdk\Exceptions\UnauthenticatedException;
use YouCan\Shop\Sdk\Models\AccessToken;

final class ApiService implements ApiServiceInterface
{
    private HTTPAdapter $httpAdapter;

    public function __construct(HTTPAdapterPicker $adapterPicker)
    {
        $this->httpAdapter = $adapterPicker->pickAdapter();
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

        if ($response->getStatusCode() === 401) {
            UnauthenticatedException::throw('unauthenticated');
        }

        if ($response->getStatusCode() === 403) {
            UnauthorizedException::throw('unauthorized');
        }

        return $response;
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
