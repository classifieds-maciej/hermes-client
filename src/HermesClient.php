<?php
namespace classifieds\maciej\hermes\client;

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
     * HermesClient constructor.
     * @param string $uri
     * @param HermesSender $sender
     */
    public function __construct(string $uri, HermesSender $sender)
    {
        $this->uri = $uri;
        $this->sender = $sender;
    }

    /**
     * @param HermesMessage $message
     * @return HermesResponse
     */
    public function publish(HermesMessage $message): HermesResponse
    {
        return $this->sender->send($this->uri . $message->getTopic(), $message);
    }
}