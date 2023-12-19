<?php

namespace Tests\Unit\Product;

use Tests\API\FakeAPIService;
use Tests\BaseTestCase;
use YouCan\Shop\Sdk\Client\Response;
use YouCan\Shop\Sdk\Endpoints\ProductEndpoint;
use YouCan\Shop\Sdk\YouCan;

class ProductEndpointTest extends BaseTestCase
{
    public function test_account_info_return_success()
    {
        $requestParam['data'] = ['id' => '73679d2e-9506-4e5f-aeca-a719ed707376'];

        $fakeResponse = new Response(200, $requestParam);

        $apiService = new FakeAPIService($fakeResponse);
        $youcan = new YouCan($apiService);

        $data = $youcan->request(ProductEndpoint::index())['data'];

        $this->assertEquals('73679d2e-9506-4e5f-aeca-a719ed707376', $data['id']);
    }
}
