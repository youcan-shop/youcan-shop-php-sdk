<?php

namespace YouCan\Shop\Sdk\Models;

class AccessToken
{
    private string $token;
    private int $expiresIn;
    private ?string $refreshToken;

    public function __construct(
        string $token,
        int $expiresIn,
        ?string $refreshToken = null
    ) {
        $this->token = $token;
        $this->expiresIn = $expiresIn;
        $this->refreshToken = $refreshToken;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setRefreshToken(string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }

    public function hasExpired(): bool
    {
        return $this->expiresIn < time();
    }
}
