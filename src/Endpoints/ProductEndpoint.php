<?php

namespace YouCan\Shop\Sdk\Endpoints;

class ProductEndpoint extends Endpoint
{
    public const BASE_ENDPOINT = 'products';

    public static function index(): self
    {
        return new self(self::BASE_ENDPOINT);
    }

    public static function show(string $id): self
    {
        return new self(sprintf("%s/%s", self::BASE_ENDPOINT, $id));
    }
}
