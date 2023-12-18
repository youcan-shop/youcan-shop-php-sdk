<?php

namespace Tests\API;

use YouCan\Shop\Sdk\Client\ApiServiceInterface;
use YouCan\Shop\Sdk\Client\HTTPAdapter\HTTPAdapter;
use YouCan\Shop\Sdk\Client\Response;
use YouCan\Shop\Sdk\Models\AccessToken;

class FakeAPIService implements ApiServiceInterface
{
    private Response $response;
    private HTTPAdapter $httpAdapter;

    public function __construct(Response $response)
    {
        $this->response = $response;

        $this->httpAdapter = new FakeApiAdapter();
        $this->httpAdapter->setFakeResponse($response);
    }

    public function request(string $endpoint, string $method, array $params = []): Response
    {
        return $this->httpAdapter->request($method, $endpoint, $params);
    }

    public function post(string $endpoint, array $params = []): Response
    {
        return $this->httpAdapter->get($endpoint, $params);
    }

    public function get(string $endpoint, array $params = []): Response
    {
        return $this->httpAdapter->get($endpoint, $params);
    }

    public function setToken(AccessToken $token): void
    {
        $this->httpAdapter->setToken($token);
    }
}
