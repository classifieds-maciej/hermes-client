<?php
use classifieds\maciej\hermes\client\HermesClient;
use classifieds\maciej\hermes\client\HermesException;
use classifieds\maciej\hermes\client\HermesMessage;
use classifieds\maciej\hermes\client\HermesResponse;
use classifieds\maciej\hermes\client\GuzzleSender;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

$hermesClient = new HermesClient(new GuzzleSender(new Client(['http_errors' => false])), 'http://localhost:8080/topics/');
$hermesMessage = new HermesMessage('test.group.test_topic', [], 'async test body with timestamp ' . date('Y-m-d H:i:s'));

echo "Async publish..\n";
$hermesClient->publishAsync(
    $hermesMessage,
    function (HermesResponse $response) {
        print_r($response);
    },
    function (HermesException $e, HermesMessage $message) {
        print_r($e);
        print_r($message);
    }
);

echo "END\n";