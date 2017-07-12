<?php
namespace classifieds\maciej\hermes\client;

use classifieds\maciej\hermes\client\subscriber\HermesReceivedMessage;
use classifieds\maciej\hermes\client\subscriber\HermesReceivedMessageFactory;
use classifieds\maciej\hermes\client\subscriber\HermesRequestInterface;
use PHPUnit\Framework\TestCase;

class HermesSubscriberTest extends TestCase
{
    public function testReturnsReceivedMessageObject()
    {
        $message = $this->createMock(HermesReceivedMessage::class);

        $messageFactory = $this->createMock(HermesReceivedMessageFactory::class);
        $messageFactory->expects($this->once())
            ->method('create')
            ->with($this->equalTo('test body'), $this->equalTo(['header' => 'value']))
            ->willReturn($message);

        $request = $this->createMock(HermesRequestInterface::class);
        $request->method('getBody')
            ->willReturn('test body');
        $request->method('getHeaders')
            ->willReturn(['header' => 'value']);

        $subscriber = new HermesSubscriber($messageFactory);
        $message = $subscriber->getMessage($request);

        $this->assertInstanceOf(HermesReceivedMessage::class, $message);
    }
}