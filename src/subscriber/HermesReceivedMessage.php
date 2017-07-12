<?php
namespace classifieds\maciej\hermes\client\subscriber;

class HermesReceivedMessage
{
    /**
     * @var array
     */
    private $headers;

    /**
     * @var string
     */
    private $body;

    /**
     * HermesReceivedMessage constructor.
     * @param string $body
     * @param array $headers
     */
    function __construct(string $body, array $headers)
    {
        $this->body = $body;
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string|null
     */
    public function getHermesMessageId()
    {
        return $this->headers['Hermes-Message-Id'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getHermesRetryCount()
    {
        return $this->headers['Hermes-Retry-Count'] ?? null;
    }
}