<?php

namespace YouCan\Shop\Sdk\Client;

class Response
{
    private int $statusCode;

    private array $response;

    public function __construct(int $statusCode, array $response)
    {
        $this->statusCode = $statusCode;
        $this->response = $response;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getResponse(): array
    {
        return $this->response;
    }

    /**
     * Get a value from response body
     *
     * @param string $key
     */
    public function get(string $key): ?string
    {
        return $this->getResponse()[$key] ?? null;
    }
}
