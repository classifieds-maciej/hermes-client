<?php
namespace classifieds\maciej\hermes\client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\ResponseInterface;

class GuzzleSender implements HermesSender
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * GuzzleSender constructor.
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

    /**
     * @param string $uri
     * @param HermesMessage $message
     * @param callable $onSuccess
     * @param callable $onFailure
     */
    public function sendAsync(string $uri, HermesMessage $message, callable $onSuccess, callable $onFailure)
    {
        $request = new Request('POST', $uri, $message->getHeaders(), $message->getBody());

        $promise = $this->client->sendAsync($request);

        $promise->wait();

        $promise->then(
            function (ResponseInterface $res) use ($onSuccess, $onFailure, $message) {
                $response = new HermesResponse(
                    $res->getStatusCode(),
                    $res->getHeaders(),
                    $res->getBody()->getContents()
                );

                if ($response->isSuccess()) {
                    $onSuccess($response);
                } else {
                    $onFailure(new HermesException($response->getBody(), $response->getHttpCode()), $message);
                }
            },
            function (RequestException $e) use ($onFailure, $message) {
                $onFailure(new HermesException($e->getMessage(), $e->getCode(), $e), $message);
            }
        );
    }


}