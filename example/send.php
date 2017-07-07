<?php
use classifieds\maciej\hermes\client\HermesMessage;
use classifieds\maciej\hermes\client\SyncSender;
use GuzzleHttp\Client;

require __DIR__ . '/../vendor/autoload.php';

// config
$uri = 'http://localhost:8080/topics/test.group.test_topic';


$sender = new SyncSender(new Client());
$message = new HermesMessage('test.topic', [], 'test body');

$response = $sender->send($uri, $message);
print_r($response);