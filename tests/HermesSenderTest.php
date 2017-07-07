<?php
namespace classifieds\maciej\hermes\client;

use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class HermesSenderTest extends TestCase
{
    public function testIfSendingHermesMessageThanShouldReturnHermesResponse()
    {
        $client = $this->getMockForAbstractClass(ClientInterface::class);
        $response = $this->getMockForAbstractClass(ResponseInterface::class);
        $body = $this->getMockForAbstractClass(StreamInterface::class);
        $body->method('getContents')->willReturn('Created');

        $response->method('getBody')->willReturn($body);
        $response->method('getStatusCode')->willReturn(201);
        $response->method('getHeaders')->willReturn([]);

        $client->method('send')->willReturn($response);

        $sender = new SyncSender($client);


        $message = new HermesMessage('topic', [], 'body');

        $response = $sender->send('uri', $message);

        $this->assertInstanceOf(HermesResponse::class, $response);
    }
}