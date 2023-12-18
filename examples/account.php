<?php

use YouCan\Pay\Sdk\YouCan;

$clientId = '1aa2c45';
$clientSecret = '1aa2c45';
$username = 'youcanpay';
$password = '*********';
$tokenUrl = 'https://api.youcanpay.com/login';

// Creating an Instance
$youCanPay = YouCan::connect(
    $clientId,
    $clientSecret,
    $username,
    $password,
    $tokenUrl
);


try {
    // Creating a Token
    $youCanPay->accessToken()->setToken();

    // Access TransactionEndpoint
    $accountEndpoint = $youCanPay->account();

    // Get Account
    $account = $accountEndpoint->info();

    // get account balance
    $account->getBalance();

    // get account hold
    $account->getHold();

} catch (\Exception $e) {
    // Handle Exception
}
