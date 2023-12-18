<?php

namespace YouCan\Shop\Sdk\Endpoints;

abstract class Endpoint
{
    private string $endpoint;
    private array $params;
    private array $headers;
    private string $method;

    public function __construct(string $endpoint, string $method = 'GET', array $params = [], array $headers = [])
    {
        $this->endpoint = $endpoint;
        $this->params = $params;
        $this->headers = $headers;
        $this->method = $method;
    }

    abstract public static function index(): self;

    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getMethod(): string
    {
        return $this->method;
    }
}
