<?php
namespace classifieds\maciej\hermes\client;

use PHPUnit\Framework\TestCase;

class HermesResponseTest extends TestCase
{
    public function test201ResponseShouldBeSuccessful()
    {
        $response = new HermesResponse(201, [], '');

        $this->assertTrue($response->isSuccess());
    }

    public function test404ResponseShouldBeFailure()
    {
        $response = new HermesResponse(404, [], '');

        $this->assertTrue($response->isFailure());
    }
}