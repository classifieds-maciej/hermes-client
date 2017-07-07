<?php
namespace classifieds\maciej\hermes\client;

class HermesResponse
{
    /**
     * @var int
     */
    private $httpCode;

    /**
     * @var array
     */
    private $headers;

    /**
     * @var array
     */
    private $body;

    /**
     * HermesResponse constructor.
     * @param int $httpCode
     * @param array $headers
     * @param array $body
     */
    public function __construct(int $httpCode, array $headers, array $body)
    {
        $this->httpCode = $httpCode;
        $this->headers = $headers;
        $this->body = $body;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return in_array($this->httpCode, [201, 202]);
    }

    /**
     * @return bool
     */
    public function isFailure(): bool
    {
        return !$this->isSuccess();
    }

    /**
     * @return string
     */
    public function getProtocol(): string
    {
        return 'http/1.1';
    }

    /**
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpCode;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getMessageId(): string
    {
        return $this->headers['Hermes-Message-Id'] ?? '';
    }

    /**
     * @param string $header
     * @return string
     */
    public function getHeader(string $header): string
    {
        return $this->headers[$header] ?? '';
    }
}