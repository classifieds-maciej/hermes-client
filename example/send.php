<?php
use classifieds\maciej\hermes\client\HermesClient;
use classifieds\maciej\hermes\client\HermesMessage;
use classifieds\maciej\hermes\client\SyncSender;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

$response = (new HermesClient('http://localhost:8080/topics/', new SyncSender(new Client())))
    ->publish(new HermesMessage('test.group.test_topic', [], 'test body'));

print_r($response);