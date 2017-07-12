<?php

use classifieds\maciej\hermes\client\HermesSubscriber;
use classifieds\maciej\hermes\client\subscriber\HermesRequestInterface;

require __DIR__ . '/../vendor/autoload.php';

//simple implementation
class Request implements HermesRequestInterface
{
    public function getBody(): string
    {
        return $_POST;
    }

    public function getHeaders(): array
    {
        return apache_request_headers();
    }
}

$request = new Request();

$subscriber = new HermesSubscriber();
$message = $subscriber->getMessage($request);

print_r($message);