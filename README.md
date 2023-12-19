# YouCanShop SDK

This package allows the developer to interact easily with the YouCan Shop API.

## Examples

Check the `examples` folder for how to use the SDK.

```php
$youCan = YouCan::instance()->setAccessToken(new AccessToken($accessToken, 1));

$data = $youCan->request(ProductEndpoint::index());
// OR
$data = $youCan->request(ProductEndpoint::show('product_id'));
```
