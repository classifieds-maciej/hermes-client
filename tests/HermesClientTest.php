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

        $hermesClient = new HermesClient($sender, 'http://example.com');

        $message = new HermesMessage('topic', [], 'body');

        $response = $hermesClient->publish($message);

        $this->assertInstanceOf(HermesResponse::class, $response);
    }

    public function testIfRetriesGivenThanShouldTryToSendNumberOfTimes()
    {
        $sender = $this->getMockForAbstractClass(HermesSender::class);
        $sender->expects($this->exactly(2))->method('send')->willReturn(new HermesResponse(501, [], ''));

        $hermesClient = new HermesClient($sender, 'http://example.com', 2);

        $message = new HermesMessage('topic', [], 'body');

        $response = $hermesClient->publish($message);

        $this->assertFalse($response->isSuccess());
    }
}