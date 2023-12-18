<?php

namespace YouCan\Shop\Sdk\Client\HTTPAdapter;

use YouCan\Shop\Sdk\Client\Response;
use YouCan\Shop\Sdk\Models\AccessToken;

abstract class HTTPAdapter
{
    public const BASE_APP_URL = 'https://api.youcan.shop/';
    private ?AccessToken $token = null;

    public function __construct(?string $token = null)
    {
        $this->token = $token;
    }

    protected function getBaseUrl(): string
    {
        return getenv('YOUCAN_SHOP_URL') ?: self::BASE_APP_URL;
    }

    public function get(string $endpoint, array $params = [], array $headers = []): Response
    {
        $this->addTokenToHeader($headers);

        return $this->request('GET', $endpoint, $params, $headers);
    }

    public function post(string $endpoint, array $params = [], array $headers = []): Response
    {
        $this->addTokenToHeader($headers);

        return $this->request('POST', $endpoint, $params, $headers);
    }

    public function setToken(AccessToken $token): void
    {
        $this->token = $token;
    }

    private function addTokenToHeader(array &$headers): void
    {
        if ($this->token) {
            $headers['Authorization'] = 'Bearer ' . $this->token;
        }
    }

    abstract public function request(string $method, string $endpoint, array $params = [], array $headers = []): Response;
}
