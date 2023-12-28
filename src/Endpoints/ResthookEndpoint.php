<?php

namespace YouCan\Shop\Sdk\Endpoints;

class ResthookEndpoint extends Endpoint
{
    public const BASE_ENDPOINT = 'resthooks';

    public static function index(): Endpoint
    {
        return self::list();
    }

    /**
     * @see https://developer.youcan.shop/store-admin/resthooks/list.html
     * @return static
     */
    public static function list(): self
    {
        return new self(sprintf("%s/%s", self::BASE_ENDPOINT, 'list'));
    }

    /**
     * @see https://developer.youcan.shop/store-admin/resthooks/subscribe.html
     * @return static
     */
    public static function subscribe(string $event, string $url): self
    {
        return new self(sprintf("%s/%s", self::BASE_ENDPOINT, 'subscribe'), 'POST', [
            'event' => $event,
            'target_url' => $url,
        ]);
    }

    /**
     * @see https://developer.youcan.shop/store-admin/resthooks/unsubscribe.html
     * @param string $id
     * @return static
     */
    public static function unsubscribe(string $id): self
    {
        return new self(sprintf("%s/%s/%s", self::BASE_ENDPOINT, 'unsubscribe', $id), 'POST');
    }
}
