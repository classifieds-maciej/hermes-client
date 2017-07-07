<?php
namespace classifieds\maciej\hermes\client;

use GuzzleHttp\ClientInterface;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class HermesClientTest extends TestCase
{
    public function testIfPublishingHermesMessageThanShouldReturnHermesResponse()
    {
        $sender = $this->getMockForAbstractClass(HermesSender::class);
        $sender->method('send')->willReturn(new HermesResponse(201, [], ''));

        $hermesClient = new HermesClient('http://example.com', $sender);

        $message = new HermesMessage('topic', [], 'body');

        $response = $hermesClient->publish($message);

        $this->assertInstanceOf(HermesResponse::class, $response);
    }
}