<?php

require __DIR__.'/../vendor/autoload.php';

use YouCan\Shop\Sdk\Endpoints\ProductEndpoint;
use YouCan\Shop\Sdk\Models\AccessToken;
use YouCan\Shop\Sdk\YouCan;

$accessToken = '';

// Creating an Instance
$youCan = YouCan::instance()->setAccessToken(new AccessToken($accessToken, 1));


try {
    $data = $youCan->request(ProductEndpoint::index());

    var_dump($data);
    die('done');
} catch (\Exception $e) {
    die($e->getMessage());
}
