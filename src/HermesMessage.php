<?php
namespace classifieds\maciej\hermes\client;

class HermesMessage
{
    /**
     * @var string
     */
    private $topic;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var string
     */
    private $body;

    /**
     * Message constructor.
     * @param string $topic
     * @param array $headers
     * @param string $body
     */
    public function __construct(string $topic, array $headers = [], string $body = '')
    {
        $this->topic = $topic;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getTopic(): string
    {
        return $this->topic;
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
     * @return string
     */
    public function __toString()
    {
        return json_encode([
            'topic' => $this->topic,
            'headers' => $this->headers,
            'body' => $this->body
        ]);
    }
}