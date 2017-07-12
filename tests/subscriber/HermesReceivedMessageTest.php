<?php
namespace classifieds\maciej\hermes\client\subscriber;

use PHPUnit\Framework\TestCase;

class HermesReceivedMessageTest extends TestCase
{
    public function testReturnsNotChangedBody()
    {
        $message = new HermesReceivedMessage('test body', []);

        $this->assertEquals('test body', $message->getBody());
    }

    public function testReturnsNotChangedHeaders()
    {
        $message = new HermesReceivedMessage('test body', ['header' => 'value']);

        $this->assertEquals(['header' => 'value'], $message->getHeaders());
    }

    public function testReturnsNullAsMessageIdIfHeaderNotSpecified()
    {
        $message = new HermesReceivedMessage('test body', ['header' => 'value']);

        $this->assertNull($message->getHermesMessageId());
    }

    public function testReturnsNullAsRetryCountIfHeaderNotSpecified()
    {
        $message = new HermesReceivedMessage('test body', ['header' => 'value']);

        $this->assertNull($message->getHermesRetryCount());
    }

    public function testReturnsCorrectMessageIdIfHeaderSpecified()
    {
        $message = new HermesReceivedMessage('test body', ['Hermes-Message-Id' => 'aaa-bbb']);

        $this->assertEquals('aaa-bbb', $message->getHermesMessageId());
    }

    public function testReturnsCorrectRetryCountIfHeaderSpecified()
    {
        $message = new HermesReceivedMessage('test body', ['Hermes-Retry-Count' => 123]);

        $this->assertEquals(123, $message->getHermesRetryCount());
    }
}