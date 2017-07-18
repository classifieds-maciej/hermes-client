<?php
use classifieds\maciej\hermes\client\HermesClient;
use classifieds\maciej\hermes\client\HermesMessage;
use classifieds\maciej\hermes\client\SyncSender;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

$response = (new HermesClient(new SyncSender(new Client()), 'http://localhost:8080/topics/'))
    ->publish(new HermesMessage('test.group.test_topic', [], 'test body'));

print_r($response);