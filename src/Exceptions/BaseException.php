<?php

namespace YouCan\Shop\Sdk\Endpoints\Exceptions;

use Throwable;

class BaseException extends \RuntimeException
{
    protected ?string $response;

    public function __construct(
        string $message,
        ?string $response = null,
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->response = $response;
    }

    public static function throw(
        string $message,
        ?string $response = null,
        int $code = 0,
        Throwable $previous = null
    ) {
        return new static($message, $response, $code, $previous);
    }

    public function getResponse(): ?string
    {
        return $this->response;
    }

    public function hasResponse(): bool
    {
        return $this->response !== null;
    }
}
