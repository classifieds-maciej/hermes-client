<?php
namespace classifieds\maciej\hermes\client;

use InvalidArgumentException;

/**
 * Class HermesClient
 * @package classifieds\maciej\hermes\client
 */
class HermesClient
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var HermesSender
     */
    private $sender;

    /**
     * @var int
     */
    private $retries;

    /**
     * @var int
     */
    private $retrySleep;

    /**
     * HermesClient constructor.
     * @param string $uri
     * @param HermesSender $sender
     * @param int $retries
     * @param int $retrySleep
     */
    public function __construct(HermesSender $sender, string $uri, int $retries = 3, int $retrySleep = 100)
    {
        if ($retries <= 0) {
            throw new InvalidArgumentException('Retries has to be greater than 0');
        }

        if ($retrySleep <= 0) {
            throw new InvalidArgumentException('Retry sleep has to be greater than 0');
        }

        $this->uri = $uri;
        $this->sender = $sender;
        $this->retries = $retries;
        $this->retrySleep = $retrySleep;
    }

    /**
     * @param HermesMessage $message
     * @return HermesResponse
     */
    public function publish(HermesMessage $message): HermesResponse
    {
        $response = null;
        for ($i = 0; $i < $this->retries; $i++) {
            $response = $this->sender->send($this->uri . $message->getTopic(), $message);

            if ($response->isSuccess()) {
                return $response;
            }

            if ($this->retries - 1 != $i) {
                usleep($this->retrySleep);
            }
        }

        return $response;
    }

    /**
     * @param HermesMessage $message
     * @param callable $onSuccess
     * @param callable $onFailure
     */
    public function publishAsync(HermesMessage $message, callable $onSuccess, callable $onFailure)
    {
        $this->sender->sendAsync($this->uri . $message->getTopic(), $message, $onSuccess, $onFailure);
    }
}