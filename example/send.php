<?php
use classifieds\maciej\hermes\client\HermesClient;
use classifieds\maciej\hermes\client\HermesMessage;
use classifieds\maciej\hermes\client\GuzzleSender;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

$hermesClient = new HermesClient(new GuzzleSender(new Client()), 'http://localhost:8080/topics/');
$hermesMessage = new HermesMessage('test.group.test_topic', [], 'test body with timestamp ' . date('Y-m-d H:i:s'));

echo "Sync publish..\n";
$response = $hermesClient->publish($hermesMessage);

print_r($response);