<?php

namespace Tests\API;

use YouCan\Shop\Sdk\Client\HTTPAdapter\HTTPAdapter;
use YouCan\Shop\Sdk\Client\Response;

class FakeAPIAdapter extends HTTPAdapter
{
    private Response $fakeResponse;

    public function setFakeResponse(Response $response): self
    {
        $this->fakeResponse = $response;

        return $this;
    }

    public function request(string $method, string $endpoint, array $params = [], array $headers = []): Response
    {
        return $this->fakeResponse;
    }
}
