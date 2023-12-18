<?php

namespace YouCan\Shop\Sdk;

use YouCan\Shop\Sdk\Client\ApiServiceInterface;
use YouCan\Shop\Sdk\Endpoints\Endpoint;
use YouCan\Shop\Sdk\Models\AccessToken;

class YouCan
{
    private ApiServiceInterface $apiService;

    public function __construct(ApiServiceInterface $apiService) {
        $this->initializeServices($apiService);
    }

    private function initializeServices(APIServiceInterface $apiService): void
    {
        $this->apiService = $apiService;
    }

    public function setAccessToken(AccessToken $accessToken): YouCan
    {
        $this->apiService->setToken($accessToken);

        return $this;
    }

    public function request(Endpoint $endpoint): array
    {
        return $this->apiService->request(
            $endpoint->getEndpoint(),
            $endpoint->getMethod(),
            $endpoint->getParams()
        )->getResponse();
    }
}