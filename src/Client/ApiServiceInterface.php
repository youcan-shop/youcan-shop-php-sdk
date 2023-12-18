<?php

namespace YouCan\Shop\Sdk\Client;

use YouCan\Shop\Sdk\Models\AccessToken;

interface ApiServiceInterface
{
    public function request(string $endpoint, string $method, array $params = []): Response;

    public function post(string $endpoint, array $params = []): Response;

    public function get(string $endpoint, array $params = []): Response;

    public function setToken(AccessToken $token): void;
}
