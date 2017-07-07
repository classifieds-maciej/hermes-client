<?php
namespace classifieds\maciej\hermes\client;

use PHPUnit\Framework\TestCase;

class HermesMessageTest extends TestCase
{
    public function testEmptyMessageShouldSerializeToString()
    {
        $expected = '{"topic":"test_topic","headers":[],"body":[]}';

        $message = new HermesMessage('test_topic');

        $this->assertEquals($expected, (string)$message);
    }

    public function testMessageShouldSerializeToString()
    {
        $expected = '{"topic":"test_topic","headers":{"test_header":"test_header"},"body":{"body_element":"test"}}';

        $message = new HermesMessage('test_topic', ['test_header' => 'test_header'], ['body_element' => 'test']);

        $this->assertEquals($expected, (string)$message);
    }
}