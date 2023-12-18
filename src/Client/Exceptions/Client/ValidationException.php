<?php

namespace YouCan\Shop\Sdk\Endpoints\Exceptions\Client;

class ValidationException extends ClientException
{
    private array $errors;

    public function __construct(
        string $message,
        ?string $response = null,
        int $code = 0,
        array $errors = [],
        \Throwable $previous = null
    ) {
        parent::__construct($message, $response, $code, $previous);

        $this->errors = $errors;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
