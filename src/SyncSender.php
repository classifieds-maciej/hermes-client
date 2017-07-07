<?php
namespace classifieds\maciej\hermes\client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Request;

class SyncSender implements HermesSender
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * SyncSender constructor.
     * @param ClientInterface $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @param HermesMessage $message
     * @return HermesResponse
     */
    public function send(string $uri, HermesMessage $message): HermesResponse
    {
        $request = new Request('POST', $uri, $message->getHeaders(), $message->getBody());

        $response = $this->client->send($request);

        return new HermesResponse(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody()->getContents()
        );
    }
}