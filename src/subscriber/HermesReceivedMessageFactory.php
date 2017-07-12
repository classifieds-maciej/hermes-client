<?php
namespace classifieds\maciej\hermes\client\subscriber;

class HermesReceivedMessageFactory
{
    /**
     * @param string $body
     * @param array $headers
     * @return HermesReceivedMessage
     */
    public function create(string $body, array $headers): HermesReceivedMessage
    {
        return new HermesReceivedMessage($body, $headers);
    }
}