<?php
namespace classifieds\maciej\hermes\client\subscriber;

use PHPUnit\Framework\TestCase;

class HermesReceivedMessageFactoryTest extends TestCase
{
    public function testCreateMessageObject()
    {
        $factory = new HermesReceivedMessageFactory();
        $message = $factory->create('body text', ['Header' => 'value']);

        $this->assertInstanceOf(HermesReceivedMessage::class, $message);
    }

    public function testCreateMessageObjectWithCorrectData()
    {
        $factory = new HermesReceivedMessageFactory();
        $message = $factory->create('body text', ['Header' => 'value']);

        $this->assertEquals('body text', $message->getBody());
        $this->assertEquals(['Header' => 'value'], $message->getHeaders());
    }
}